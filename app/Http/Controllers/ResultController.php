<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;
use App\Models\CategoryResult;
use App\Http\Controllers\Controller;
use Illuminate\Http\Client\Response;

class ResultController extends Controller
{
    public function show($result_id){
        $result = Result::whereHas('user', function ($query) {
            $query->whereId(auth()->id());
        })->findOrFail($result_id);
    
        return view('client.results', [
            'result' => $result,

        ]);
    }

    public function downloadAttachment($categoryId, $userId)
{
    $categoryResult = CategoryResult::where('category_id', $categoryId)
        ->whereHas('result', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
        ->first();

    if ($categoryResult && $categoryResult->attachment) {
        $filePath = storage_path("app/public/{$categoryResult->attachment}");
        $fileName = "nama_file_baru.ext"; // Ganti dengan nama file yang diinginkan
        return Response::download($filePath, $fileName);
    } else {
        // Handle jika file tidak ditemukan
        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }
}
}
