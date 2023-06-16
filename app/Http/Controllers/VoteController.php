<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\VoteDetail;
use Illuminate\Http\Request;
use App\Models\Candidate;
use Illuminate\Support\Facades\Auth;


class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $votes = VoteDetail::paginate(50);
        return view('vote.index', compact('votes'));
    }

    public function vote($id)
    {
        $candidates = Candidate::paginate(50);
        return view('vote.vote', compact('candidates', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vote.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        VoteDetail::create([
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
        ]);

        return redirect(route('vote.index'));
    }

    public function storeVoting(Request $request)
    {
        $user = Auth::user()->id;
        $exist_voter = Vote::where('user_id', $user)->where('vote_id', $request->vote_detail)->first();
        if($exist_voter){
            return back()->with('success', 'You Have Already Vote!');
        }
        if(count($request->vote) > 1)
        {
            return back()->with('success', 'Please Select 1 Candidate Only!');
        }

        foreach($request->vote as $key=>$ci)
        {
            Vote::create([
                'user_id' => $user,
                'vote_id' => $request->vote_detail,
                'candidate_id' => $request->vote[$key],
                'total_vote' => 1,
            ]);
        }

        return redirect(route('result.index'));
    }



    /**
     * Display the specified resource.
     */
    public function show(Vote $vote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VoteDetail $vote)
    {
        return view('vote.edit', compact("vote"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VoteDetail $vote)
    {
        $vote->update([
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
        ]);

        return redirect(route('vote.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vote $vote, $id)
    {
        $sample = VoteDetail::destroy($id);

        // Redirect to the group management page
        return redirect(route('vote.index'));
    }

    public function result()
    {
        $vote_details = VoteDetail::get();
        $candidates = Candidate::get();

        foreach($vote_details as $key => $vd)
        {
            $candidates = Candidate::get();
            $vote = Vote::where('vote_id',$vd->id)->count();
            $user_voter = Vote::select('user_id')->selectRaw('count(user_id) as qty')->where('vote_id',$vd->id)->groupBy('user_id')->get();

            $vote_details[$key]->total_candidate = count($candidates);
            $vote_details[$key]->total_vote = $vote;
            $vote_details[$key]->total_voter = count($user_voter);
            $vote_details[$key]->user_vote = $user_voter;

            foreach($candidates as $i=>$c)
            {
                $candidate_voter = 0;
                $candidate_voter = Vote::where('candidate_id', $c->id)->where('vote_id',$vd->id)->count();

                $candidates[$i]->candidate_vote_total = $candidate_voter;
            }

            
            $vote_details[$key]->candidate_vote = $candidates;
        }
        // dd($vote_details);
        return view('vote.result.index', compact('vote_details', 'candidates'));
    }
}
