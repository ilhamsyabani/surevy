<?php

namespace App\Http\Controllers\Admin;

use App\Models\Option;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\QuestionRequest;

class QuestionController extends Controller
{

    public function index(): View
    {
        $questions = Question::all();

        return view('admin.questions.index', compact('questions'));
    }

    public function create(): View
    {
        $categories = Category::all()->pluck('name', 'id');

        return view('admin.questions.create', compact('categories'));
    }

    public function store(QuestionRequest $request): RedirectResponse
    {

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'question_text' => 'required|string',
            'option_text.*' => 'required|string',
            'point.*' => 'required|numeric',
        ]);

        $question = Question::create([
            'category_id' => $request->category_id,
            'question_text' => $request->question_text
        ]);

        $opsi = $request->option_text;
        $points = $request->point;

        foreach ($opsi as $key => $value) {
            Option::create([
                'question_id' => $question->id,
                'option_text' => $value,
                'points' => $points[$key],
            ]);
        }

        return redirect()->route('admin.questions.index')->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    public function show(Question $question): View
    {
        return view('admin.questions.show', compact('question'));
    }

    public function edit(Question $question): View
    {
        $categories = Category::all()->pluck('name', 'id');

        $options = $question->questionOptions;

        return view('admin.questions.edit', compact('question', 'categories', 'options'));
    }

    public function update(QuestionRequest $request, Question $question): RedirectResponse
    {
        // Validate the request data
        $request->validate([
            'question_text' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'option_text.*' => 'required|string',
            'point.*' => 'required|numeric',
        ]);

        // Update the question
        $question->update([
            'question_text' => $request->input('question_text'),
            'category_id' => $request->input('category_id'),
        ]);

        // Update or create options
        foreach ($request->input('option_text') as $key => $optionText) {
            Option::updateOrCreate(
                ['question_id' => $question->id, 'points' => $request->input('point')[$key]],
                ['option_text' => $optionText]
            );
        }

        return redirect()->route('admin.questions.index')->with([
            'message' => 'Successfully updated!',
            'alert-type' => 'info'
        ]);
    }


    public function destroy(Question $question): RedirectResponse
    {
        $question->delete();

        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }

    public function massDestroy()
    {
        Question::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }
}
