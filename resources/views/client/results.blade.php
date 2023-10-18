@extends('layouts.client')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Results of your test</div>

                    <div class="card-body">
                        <p class="mt-5">Total points: {{ $result->total_points }} points</p>
                        @foreach ($result->categoryResults as $category)
                            <h2>Kategori Soal ID: {{ $category->category->name }}</h2>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Question Text</th>
                                        <th>Points</th>
                                        <th style="text-align: center">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $rowCount = count($category->questionResult);
                                    @endphp

                                    @foreach ($category->questionResult as $question)
                                        <tr>
                                            <td>{{ $question->question->question_text }}</td>
                                            <td>{{ $question->points }}</td>
                                            @if ($loop->first)
                                                <td rowspan="{{ $rowCount + 1 }}" style="text-align: center;"><p style="font-size:100px">{{ $category->feedback->score }}</p>
                                                <p>{{ $category->feedback->feedback }}</p></td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td>Jumlah</td>
                                        <td>{{ $category->total_points }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="mt-4">
                                <p>file yang sudah di upload<a href="{{ asset('storage/' . $category->attachment) }}"
                                    class="pt-8 btn-link"
                                    download>{{ $category->attachment }}</a><br/></p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
