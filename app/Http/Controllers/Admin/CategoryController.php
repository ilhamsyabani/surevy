<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Feedback;
use App\Models\Range;

class CategoryController extends Controller
{

    public function index(): View
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(CategoryRequest $request): RedirectResponse
    {


        $categori = Category::create($request->validated());

        $request->validate([
            'score' => 'required|array|min:1',
            'score.*' => 'required|string',
            'min' => 'required|array|min:1',
            'min.*' => 'required|numeric',
            'max' => 'required|array|min:1',
            'max.*' => 'required|numeric',
            'feedback' => 'required|array|min:1',
            'feedback.*' => 'required|string',
        ]);

        $ranges = [];

        for ($i = 0; $i < count($request->score); $i++) {
            $ranges[] = [
                'categori_id' =>  $categori->id,
                'score' => $request->score[$i],
                'min' => $request->min[$i],
                'max' => $request->max[$i],
                'feedback' => $request->feedback[$i],
            ];
        }
        Feedback::insert($ranges);

        return redirect()->route('admin.categories.index')->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    public function show(Category $category): View
    {
        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->validated());

        return redirect()->route('admin.categories.index')->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
        ]);
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }

    public function massDestroy()
    {
        Category::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }
}
