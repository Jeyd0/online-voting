<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard(){
        $candidates = Candidate::withCount('votes')->get();
        return view('admin.dashboard', compact('candidates'));
    }

    public function candidates(){
        $candidates = Candidate::all();
        return view('admin.candidates.index', compact('candidates'));
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

    public function destroyCandidate(Candidate $candidate){
        $candidate->delete();
        return back()->with('success', 'Candidate deleted successfully');
    }

    public function users(){
        $users = User::where('role', '!=', 'admin')->get();
        return view('admin.users.index', compact('users'));
    }

    public function destroyUser(User $user){
        if($user->role === 'admin'){
            return back()->with('error', 'Cannot delete admin user');
        }
        $user->delete();
        return back()->with('success', 'User deleted successfully');
    }
}
