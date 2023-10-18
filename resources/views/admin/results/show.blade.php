@extends('layouts.admin')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->


        <!-- Content Row -->
        <div class="card">
            <div class="card-header py-3 d-flex">
                <h6 class="m-0 font-weight-bold text-primary">
                    Total points: {{ $result->total_points }} points
                </h6>
                <div class="ml-auto">
                    <a href="{{ route('admin.results.index') }}" class="btn btn-primary">
                        <span class="text">{{ __('Go Back') }}</span>
                    </a>
                </div>
            </div>
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
                @endforeach
            </div>
        </div>
        <!-- Content Row -->

    </div>
@endsection
