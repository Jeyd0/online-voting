<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\User;
use App\Models\Vote;

class AdminController extends Controller
{
    public function dashboard(){
        $candidates = Candidate::withCount('votes')->get();
        return view('admin.dashboard', compact('candidates'));
    }

    public function candidates(Request $request){
        $search = $request->get('search');
        
        $candidates = Candidate::query()
            ->when($search, function($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                            ->orWhere('position', 'like', "%{$search}%")
                            ->orWhere('party', 'like', "%{$search}%");
            })
            ->get();
            
        return view('admin.candidates.index', compact('candidates', 'search'));
    }

    public function createCandidate(){
        return view('admin.candidates.create');
    }

    public function storeCandidate(Request $request){
        $request->validate([
            'name' => 'required|string|max:255|unique:candidates,name',
            'position' => 'required|string|max:255',
            'party' => 'required|string|max:255',
        ]);

        Candidate::create([
            'name' => $request->name,
            'position' => $request->position,
            'party' => $request->party,
            'election_id' => 1 // Default election ID for now
        ]);

        return redirect()->route('admin.candidates.index')->with('success', 'Candidate added successfully');
    }

    public function editCandidate(Candidate $candidate){
        return view('admin.candidates.edit', compact('candidate'));
    }

    public function updateCandidate(Request $request, Candidate $candidate){
        $request->validate([
            'name' => 'required|string|max:255|unique:candidates,name,' . $candidate->id,
            'position' => 'required|string|max:255',
            'party' => 'required|string|max:255',
        ]);

        $candidate->update([
            'name' => $request->name,
            'position' => $request->position,
            'party' => $request->party,
        ]);

        return redirect()->route('admin.candidates.index')->with('success', 'Candidate updated successfully');
    }

    public function destroyCandidate(Candidate $candidate){
        $candidate->delete();
        return back()->with('success', 'Candidate deleted successfully');
    }

    public function destroyAllCandidates(){
        // Delete all votes first, then all candidates
        Vote::truncate();
        Candidate::truncate();
        return back()->with('success', 'All candidates and votes deleted successfully');
    }

    public function users(Request $request){
        $search = $request->get('search');
        
        $users = User::query()
            ->where('role', '!=', 'admin')
            ->with('votes')
            ->when($search, function($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('role', 'like', "%{$search}%");
            })
            ->get();
            
        return view('admin.users.index', compact('users', 'search'));
    }

    public function destroyUser(User $user){
        if($user->role === 'admin'){
            return back()->with('error', 'Cannot delete admin user');
        }
        $user->delete();
        return back()->with('success', 'User deleted successfully');
    }

    public function destroyAllUsers(){
        User::where('role', '!=', 'admin')->delete();
        return back()->with('success', 'All users deleted successfully');
    }

    public function results(){
        $positions = Candidate::withCount('votes')->get()->groupBy('position');
        $election = \App\Models\Election::find(1);
        return view('admin.results', compact('positions', 'election'));
    }

    public function toggleVoting(){
        $election = \App\Models\Election::find(1);
        if($election){
            // Cycle through: pending -> active -> closed -> pending
            if($election->status === 'pending'){
                $election->status = 'active';
                $message = 'Voting has been started successfully';
            } elseif($election->status === 'active'){
                $election->status = 'closed';
                $message = 'Voting has been stopped successfully';
            } else {
                $election->status = 'pending';
                $message = 'Voting has been reset to pending';
            }
            $election->save();
            return back()->with('success', $message);
        }
        return back()->with('error', 'Election not found');
    }
}
