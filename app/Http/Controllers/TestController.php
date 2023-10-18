<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Result;
use App\Models\Category;
use App\Models\Feedback;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\CategoryResult;
use App\Models\QuestionResult;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTestRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateTestRequest;

class TestController extends Controller
{
    public function index()
    {

        foreach(auth()->user()->roles as $role){
            if($role->title == "admin"){
                return redirect()->route('dashboard.index');
            }
            if($role->title == "evaluator"){
                return redirect()->route('dashboard.index');
            }
        }

        $categories = Category::whereHas('categoryQuestions')
            ->get();

        $result = Result::where('user_id', auth()->id())->first();


        if (!$result) {
        return view('client.test', compact('categories'));
        }
        if($result->status == "simpan"){
            $result_id = $result->id;
            return redirect()->route('client.test.edit',  $result_id);
        }
        if($result->status == "kirim"){
            return view('client.waiting');
        }
        if($result->status == "disetujui"){
            return redirect()->route('client.results.show', $result);
        }

        
    }

    public function edit($result_id)
    {
        $result = Result::whereHas('user', function ($query) {
            $query->whereId(auth()->id());
        })->findOrFail($result_id);

        $categoryRes = CategoryResult::where('result_id', $result->id)->get();

        $resultquestion = QuestionResult::whereIn('category_result_id', $categoryRes->pluck('id'))->get();

        $categories = Category::whereHas('categoryQuestions')
            ->get();

        return view('client.edit', [
            'result' => $result,
            'categoriresult' => $categoryRes,
            'resultquestion' => $resultquestion,
            'categories' => $categories,
        ]);
    }


    public function store(StoreTestRequest $request)
    {

        $options = Option::find(array_values($request->input('questions')));

        $result = auth()->user()->userResults()->create([
            'total_points' => $options->sum('points'),
            'status' => $request->aksi
        ]);

        // Temukan pertanyaan yang terkait dengan opsi yang dipilih
        $questions = Question::whereIn('id', $options->pluck('question_id'))->get();

        // Mengelompokkan pertanyaan berdasarkan kategori soal
        $questionsByCategory = $questions->groupBy('category_id');

        // Menyimpan data kategori hasil tes ke dalam tabel category_result
        foreach ($questionsByCategory as $categoryId => $categoryQuestions) {
            $totalPoints = 0;

            foreach ($categoryQuestions as $question) {
                $selectedOptionId = $request->input('questions')[$question->id];
                $selectedOption = $options->where('id', $selectedOptionId)->first();
                $totalPoints += $selectedOption->points;
            }

            $feedback = Feedback::where('categori_id', $categoryId)
                ->where('min', '<=', $totalPoints)
                ->where('max', '>=', $totalPoints)
                ->first();
            if (!$feedback) {
                $feedback = Feedback::find(1);
            }

            $path = 'kosong';
            if ($request->hasFile('attachment')) {
                $attachments = $request->file('attachment');
                if (is_array($attachments) && array_key_exists($categoryId, $attachments)) {
                    $attachment = $attachments[$categoryId];
                    $path = $attachment->store('uploads', 'public');
                } else {
                    $path = 'belum di isi';
                }
            }

            $categoryResult = new CategoryResult([
                'total_points' => $totalPoints,
                'attachment' => $path, // Misalnya, jika attachment juga disimpan dalam tabel category_result
            ]);

            // Menyimpan ID hasil tes dan ID feedback ke dalam tabel category_result
            $categoryResult->result()->associate($result);
            $categoryResult->feedback()->associate($feedback);
            $categoryResult->category()->associate($categoryId);
            $categoryResult->save();


            foreach ($categoryQuestions as $question) {
                $selectedOptionId = $request->input('questions')[$question->id];
                $selectedOption = Option::find($selectedOptionId);

                $questionResult = new QuestionResult([
                    'question_id' => $question->id,
                    'option_id' => $selectedOptionId,
                    'points' => $selectedOption->points,
                ]);

                $questionResult->categoryResult()->associate($categoryResult);
                $questionResult->save();
            }
        }

        if ($request->aksi == "simpan") {
            return redirect()->route('client.test.edit',  $result->id);
        }
        return redirect()->route('client.results.show',  $result->id);
    }

    
    public function update(Request $request, $result)
    {
        $resultData = Result::find($result);
        if ($resultData->user_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Dapatkan opsi terpilih dari request
        $selectedOptions = $request->input('questions');
        $options = Option::find(array_values($request->input('questions')));

        // Temukan pertanyaan yang terkait dengan opsi yang dipilih
        $questions = Question::whereIn('id', $options->pluck('question_id'))->get();

        // Mengelompokkan pertanyaan berdasarkan kategori soal
        $questionsByCategory = $questions->groupBy('category_id');

        // Mulai transaksi database
        DB::beginTransaction();

        try {
            // Perbarui total_points pada tabel hasil ujian
            $totalPoints = Option::whereIn('id', array_values($selectedOptions))->sum('points');
            $resultData->update(['total_points' => $totalPoints]);
            $resultData->update(['status' => $request->aksi]);

            foreach ($questionsByCategory as $categoryId => $categoryQuestions) {
                $totalPoint = 0;

                foreach ($categoryQuestions as $question) {
                    $selectedOptionId = $selectedOptions[$question->id];
                    $selectedOption = Option::find($selectedOptionId);
                    $totalPoint += $selectedOption->points;
                }

                $feedback = Feedback::where('categori_id', $categoryId)
                    ->where('min', '<=', $totalPoint)
                    ->where('max', '>=', $totalPoint)
                    ->first();

                // Temukan atau buat kategori hasil ujian yang sudah ada
                $categoryResult = CategoryResult::where('result_id', $result)
                    ->where('category_id', $categoryId)
                    ->first();

                $attachmentPath = null;

                if ($request->hasFile('attachment')) {
                    $attachments = $request->file('attachment');

                    if (array_key_exists($categoryId, $attachments)) {
                        $attachment = $attachments[$categoryId];
                        if ($categoryResult && $categoryResult->attachment) {
                            // Hapus file lama jika ada
                            Storage::delete($categoryResult->attachment);
                        }

                        // Simpan file baru dan dapatkan pathnya
                        $attachmentPath = $attachment->store('uploads', 'public');
                    }
                } else {
                    // Gunakan nilai attachment dari $categoryResult jika tidak ada file yang diunggah
                    $attachmentPath = $categoryResult ? $categoryResult->attachment : null;
                }

                // Perbarui kategori hasil tes
                if ($categoryResult) {
                    $categoryResult->update(['total_points' => $totalPoint, 'attachment' => $attachmentPath]);
                } else {
                    $categoryResult = new CategoryResult([
                        'total_points' => $totalPoints,
                        'attachment' => $attachmentPath,
                    ]);
                    $categoryResult->result()->associate($result);
                    $categoryResult->feedback()->associate($feedback);
                    $categoryResult->category()->associate($categoryId);
                    $categoryResult->save();
                }

                foreach ($categoryQuestions as $question) {
                    $selectedOptionId = $selectedOptions[$question->id];
                    $selectedOption = Option::find($selectedOptionId);

                    // Temukan atau buat hasil pertanyaan yang sudah ada
                    $questionResult = QuestionResult::updateOrCreate(
                        ['category_result_id' => $categoryResult->id, 'question_id' => $question->id],
                        ['option_id' => $selectedOptionId, 'points' => $selectedOption->points]
                    );

                    // Perbarui hasil pertanyaan
                    $questionResult->update(['option_id' => $selectedOptionId, 'points' => $selectedOption->points]);
                }
            }

            // Commit transaksi jika berhasil
            DB::commit();

            if ($request->aksi == "simpan") {
                return redirect()->route('client.test.edit', $result);
            }
            if ($request->aksi == "kirim") {
                return redirect()->route('client.results.show', $result);
            }
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Tangani kesalahan sesuai kebutuhan Anda
            // ...

            // Redirect pengguna ke halaman yang sesuai dengan kesalahan yang terjadi
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi nanti.']);
        }
    }
}
