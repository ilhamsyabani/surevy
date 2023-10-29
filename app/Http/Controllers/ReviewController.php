<?php

namespace App\Http\Controllers;

use App\Models\CategoryResult;
use App\Models\Result;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ReviewController extends Controller
{

    public function index(): View
    {
        // Ambil ID instansi dari pengguna yang saat ini terautentikasi
        $instanceId = auth()->user()->instansion_id;

        // Ambil hasil ujian berdasarkan ID instansi pengguna

        $results = Result::whereHas('user', function ($query) use ($instanceId) {
            $query->where('instansion_id', $instanceId);
        })->get();



        // Kembalikan hasil ke view atau lakukan operasi lainnya
        return view('review.index', compact('results'));
    }

    public function create(): View
    {
        return view('reviews.create');
    }

    public function store(Request $request): RedirectResponse
{
    $reviewKeys = collect($request->review)->keys();

    $validatedData = $request->validate([
        'review.*' => 'required'
    ], [
        'review.*.required' => 'Review harus diisi.'
    ]);

    if ($validatedData) {
        foreach ($request->review as $key => $reviewData) {
            if ($reviewKeys->contains($key)) {
                $review = new Review([
                    'category_result_id' => $key, 
                    'user_id' => auth()->id(),
                    'review' => $reviewData
                ]);
                $review->save();
            }
        }

        // Simpan status result
        $result = Result::find($request->result_id);
        $result->status = $request->status;
        $result->save();

        // Pengalihan halaman setelah data berhasil disimpan
        return redirect()->route('admin.review.index')->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    } else {
        // Respons jika validasi gagal
        return back()->withInput()->withErrors(['review' => 'Review harus diisi.']);
    }
}


    public function show($id): View
    {
        $result = Result::find($id);
        return view('review.show', compact('result'));
    }

    public function edit(Review $review): View
    {
        return view('reviews.edit', compact('review'));
    }

    public function update(Request $request, Review $review): RedirectResponse
    {
        $review->update($request->validated());

        return redirect()->route('reviews.index')->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
        ]);
    }

    public function destroy(Review $review): RedirectResponse
    {
        $review->delete();

        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }
}
