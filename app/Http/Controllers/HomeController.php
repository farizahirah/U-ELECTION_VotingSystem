<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VoteDetail;
use App\Models\Candidate;
use App\Models\Vote;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $vote_details = VoteDetail::orderBy('id', 'desc')->get();
        $candidates = Candidate::get();

        // dd("hehe");
        return view('dashboard', compact('vote_details', 'candidates'));
    }

    public function detail($id)
    {
        $vd = VoteDetail::find($id);
        $candidates = Candidate::get();
        $candidate = Candidate::count();
        $vote = Vote::where('vote_id',$id)->count();
        $user_voter = Vote::select('user_id')->selectRaw('count(user_id) as qty')->where('vote_id',$id)->groupBy('user_id')->get();

        foreach($candidates as $key=>$c)
        {
            $candidate_voter = 0;
            $candidate_voter = Vote::where('candidate_id', $c->id)->where('vote_id',$id)->count();

            $candidates[$key]->candidate_vote = $candidate_voter;
        }

        $total_candidate = $candidate;
        $total_vote = $vote;
        $total_voter = count($user_voter);
        $user_vote = $user_voter;

        // dd($candidate_vote);
        return view('detail_dashboard', compact(
                                            'vd', 
                                            'candidates',
                                            'total_candidate',
                                            'total_vote',
                                            'total_voter',
                                            'user_vote',
                                        ));
    }
}
