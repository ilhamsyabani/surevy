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

        // Perbarui total_points pada tabel hasil ujian
        $totalPoints = Option::whereIn('id', array_values($selectedOptions))->sum('points');
        $resultData->update(['total_points' => $totalPoints]);
        $resultData->update(['status' => $request->aksi]);


        // Perbarui atau tambahkan kategori hasil tes ke dalam tabel category_result
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
                    foreach ($attachment as $data) {
                        // Hapus file yang ada jika ada
                        if ($categoryResult->attachment) {
                            Storage::delete($categoryResult->attachment);
                        }
                        // Simpan file baru
                        $attachmentPath = $data->store('uploads', 'public');
                    }
                }
            } else {
                // Gunakan nilai attachment dari $categoryResult jika tidak ada file yang diunggah
                $attachmentPath = $categoryResult->attachment;
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
            //dd($categoryResult);

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

        if ($request->aksi == "simpan") {
            return redirect()->route('client.test.edit', $result);
        }
        if ($request->aksi == "kirim") {
            return redirect()->route('client.results.show', $result);
        }

        // Mulai transaksi databas
        DB::beginTransaction();

        try {
            // Perbarui total_points pada tabel hasil ujian
            $totalPoints = Option::whereIn('id', array_values($selectedOptions))->sum('points');
            $resultData->update(['total_points' => $totalPoints]);
            $resultData->update(['status' => $request->aksi]);


            // Perbarui atau tambahkan kategori hasil tes ke dalam tabel category_result
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


                // if ($request->hasFile('attachment')) {
                //     $attachments = $request->file('attachment');
                //     $attachment = $attachments[$categoryId];
                //     foreach ($attachment as $data) {
                //         if($categoryResult->attachment){
                //             Storage::delete($categoryResult->attachment);
                //         }
                //         $attachmentPath = $data->store('uploads', 'public');
                //     }
                // }else{
                //     $attachmentPath=$categoryResult->attachment;
                // }

                // // Perbarui kategori hasil tes
                // if ($categoryResult) {
                //     $categoryResult->update(['total_points' => $totalPoint, 'attachment' => $attachmentPath]);
                // } else {
                //     $categoryResult = new CategoryResult([
                //         'total_points' => $totalPoints,
                //         'attachment' => $attachmentPath,
                //     ]);
                //     $categoryResult->result()->associate($result);
                //     $categoryResult->feedback()->associate($feedback);
                //     $categoryResult->category()->associate($categoryId);
                //     $categoryResult->save();
                // }
                if ($request->hasFile('attachment')) {
                    $attachments = $request->file('attachment');
                    $path = [];
                    dd($attachments);
                    // Simpan file baru dan dapatkan pathnya
                    foreach ($attachments[$categoryId] as $data) {
                        Storage::delete($categoryResult->attachment);
                        $path[] = $data->store('uploads', 'public');
                    }

                    // Gabungkan path file menjadi string dan simpan ke dalam database
                    $attachmentPath = implode(',', $path);
                } else {
                    // Jika tidak ada file baru, gunakan attachment lama jika ada
                    $attachmentPath = $categoryResult ? $categoryResult->attachment : '';
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