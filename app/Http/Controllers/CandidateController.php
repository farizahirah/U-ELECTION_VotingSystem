<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Candidate;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $candidates = Candidate::paginate(50);
        return view('candidate.index', compact('candidates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $user = User::find($id);
        return view('candidate.edit', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Candidate::create([
            'user_id' => $request->user_id,
            'motto' => $request->motto,
            'achievement' => $request->achievement,
        ]);

        return redirect(route('user.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Candidate $candidate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($candidate)
    {
        $user = User::find($candidate);
        $candidate = Candidate::where('user_id', $candidate)->first();
        // dd($candidate);
        return view('candidate.edit', compact('user','candidate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Candidate $candidate)
    {
        $candidate->update([
            'user_id' => $request->user_id,
            'motto' => $request->motto,
            'achievement' => $request->achievement,
        ]);

        return redirect(route('user.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidate $candidate, $id)
    {
        $sample = Candidate::destroy($id);

        // Redirect to the group management page
        return redirect(route('user.index'));
    }
}
