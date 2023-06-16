<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feedback = Feedback::paginate(15);
        return view('feedback.index', compact('feedback'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('feedback.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user()->id;
        if($request->status == 1){
            $user = 0;
        }
        Feedback::create([
            'feedback_header' => $request->feedback_header,
            'feedback_body' => $request->feedback_body,
            'user_id' => $user,
        ]);

        return redirect(route('feedback.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Feedback $feedback)
    {
        return view('feedback.view', compact('feedback'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feedback $feedback)
    {
        return view('feedback.edit', compact('feedback'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feedback $feedback)
    {
        $user = Auth::user()->id;

        $feedback->update([
            'feedback_header' => $request->feedback_header,
            'feedback_body' => $request->feedback_body,
        ]);

        return redirect(route('feedback.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feedback $feedback, $id)
    {
        $sample = Feedback::destroy($id);

        // Redirect to the group management page
        return redirect(route('feedback.index'));
    }
}
