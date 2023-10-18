<?php

namespace App\Http\Controllers;

use App\Models\Range;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RangeController extends Controller
{
   
    public function index(): View
    {
        $ranges = Range::all();

        return view('ranges.index', compact('ranges'));
    }

    public function create(): View
    {
        return view('ranges.create');
    }

    public function store(RangeRequest $request): RedirectResponse
    {
        Range::create($request->validated());

        return redirect()->route('ranges.index')->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    public function show(Range $range): View
    {
        return view('ranges.show', compact('range'));
    }

    public function edit(Range $range): View
    {
        return view('ranges.edit', compact('range'));
    }

    public function update(RangeRequest $request, Range $range): RedirectResponse
    {
        $range->update($request->validated());

        return redirect()->route('ranges.index')->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
        ]);
    }

    public function destroy(Range $range): RedirectResponse
    {
        $range->delete();

        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }
}
