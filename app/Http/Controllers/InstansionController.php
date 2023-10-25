<?php

namespace App\Http\Controllers;

use App\Models\Instansion;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Admin\InstansionRequest;

class InstansionController extends Controller
{
   
    public function index(): View
    {
        $instansions = Instansion::all();

        return view('admin.instansions.index', compact('instansions'));
    }

    public function create(): View
    {
        return view('admin.instansions.create');
    }

    public function store(InstansionRequest $request): RedirectResponse
    {
        Instansion::create($request->validated());

        return redirect()->route('admin.instansions.index')->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    public function show(Instansion $instansion): View
    {
        return view('instansions.show', compact('instansion'));
    }

    public function edit(Instansion $instansion): View
    {
        return view('admin.instansions.edit', compact('instansion'));
    }

    public function update(Request $request, Instansion $instansion): RedirectResponse
    {
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required',

        // ]);
        
        $instansion->update($request->all());

        return redirect()->route('admin.instansions.index')->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
        ]);
    }

    public function destroy(Instansion $instansion): RedirectResponse
    {
        $instansion->delete();

        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }
}
