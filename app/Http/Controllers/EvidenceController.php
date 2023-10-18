<?php

namespace App\Http\Controllers;

use App\Models\Evidence;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EvidenceController extends Controller
{
   
    public function index(): View
    {
        $evidences = Evidence::all();

        return view('evidences.index', compact('evidences'));
    }

    public function create(): View
    {
        return view('evidences.create');
    }

    public function store(EvidenceRequest $request): RedirectResponse
    {
        Evidence::create($request->validated());

        return redirect()->route('evidences.index')->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    public function show(Evidence $evidence): View
    {
        return view('evidences.show', compact('evidence'));
    }

    public function edit(Evidence $evidence): View
    {
        return view('evidences.edit', compact('evidence'));
    }

    public function update(EvidenceRequest $request, Evidence $evidence): RedirectResponse
    {
        $evidence->update($request->validated());

        return redirect()->route('evidences.index')->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
        ]);
    }

    public function destroy(Evidence $evidence): RedirectResponse
    {
        $evidence->delete();

        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }
}
