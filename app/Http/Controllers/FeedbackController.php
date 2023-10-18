<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
   
    public function index(): View
    {
        $feedbacks = Feedback::all();

        return view('feedbacks.index', compact('feedbacks'));
    }

    public function create(): View
    {
        return view('feedbacks.create');
    }

    public function store(FeedbackRequest $request): RedirectResponse
    {
        Feedback::create($request->validated());

        return redirect()->route('feedbacks.index')->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    public function show(Feedback $feedback): View
    {
        return view('feedbacks.show', compact('feedback'));
    }

    public function edit(Feedback $feedback): View
    {
        return view('feedbacks.edit', compact('feedback'));
    }

    public function update(FeedbackRequest $request, Feedback $feedback): RedirectResponse
    {
        $feedback->update($request->validated());

        return redirect()->route('feedbacks.index')->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
        ]);
    }

    public function destroy(Feedback $feedback): RedirectResponse
    {
        $feedback->delete();

        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }
}
