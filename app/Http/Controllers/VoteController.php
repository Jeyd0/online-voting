<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vote;
use App\Models\Candidate;

class VoteController extends Controller
{
    public function index()
    {
        $election = \App\Models\Election::find(1);
        if($election && $election->status === 'closed'){
            return redirect()->route('dashboard')->with('error', 'Voting has been closed.');
        }
        
        if(Vote::where('user_id', auth()->id())->exists()){
            return redirect('/thank-you');
        }
        $candidates = Candidate::all()->groupBy('position');
        return view('voter.vote', compact('candidates'));
    }

    public function results()
    {
        if(!Vote::where('user_id', auth()->id())->exists()){
            return redirect()->route('vote.index')->with('error', 'You must vote before viewing results.');
        }
        $positions = Candidate::withCount('votes')->get()->groupBy('position');
        return view('voter.results', compact('positions'));
    }

    public function vote(Request $request){
        $election = \App\Models\Election::find(1);
        if($election && $election->status === 'closed'){
            return back()->with('error', 'Voting has been closed.');
        }
        
        if(Vote::where('user_id', auth()->id())->exists()){ return back()->with('error','You already voted'); }
        
        $request->validate([
            'votes' => 'array',
            'votes.*' => 'exists:candidates,id',
        ]);

        if($request->has('votes')){
            foreach($request->votes as $position => $candidate_id){
                Vote::create([
                    'user_id'=>auth()->id(),
                    'candidate_id'=>$candidate_id
                ]);
            }
        }
        
        // If no votes were cast, we might want to record that the user participated?
        // But the current logic relies on Vote existence. 
        // If they cast 0 votes, they can vote again. This is acceptable.
        // If they cast at least 1 vote, they are locked out.

        return redirect('/thank-you');
    }
}
