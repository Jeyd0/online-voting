<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vote;
use App\Models\Candidate;

class VoteController extends Controller
{
    public function index()
    {
        $candidates = Candidate::all()->groupBy('position');
        return view('voter.vote', compact('candidates'));
    }

    public function vote(Request $request){
        if(Vote::where('user_id', auth()->id())->exists()){ return back()->with('error','You already voted'); }
        Vote::create([
            'user_id'=>auth()->id(),
            'candidate_id'=>$request->candidate_id
        ]);
        return redirect('/thank-you');
    }
}
