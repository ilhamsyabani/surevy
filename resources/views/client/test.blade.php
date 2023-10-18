@extends('layouts.client')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Test</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('client.test.store') }}" enctype="multipart/form-data">
                            @csrf
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                
                                @foreach ($categories as $category)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link @if ($loop->first) active @endif" id="tab-{{ $category->id }}-tab" data-bs-toggle="tab" data-bs-target="#tab-{{ $category->id }}" type="button" role="tab" aria-controls="tab-{{ $category->id }}" aria-selected="true">
                                            {{ $category->name }}
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                @foreach ($categories as $category)
                                    <div class="tab-pane fade @if ($loop->first) show active @endif" id="tab-{{ $category->id }}" role="tabpanel" aria-labelledby="tab-{{ $category->id }}-tab">
                                        <div class="card mt-3">
                                            <div class="card-body">
                                                <input type="hidden" name="category_id[]" value="{{ $category->id }}">
                                                @foreach ($category->categoryQuestions as $question)
                                                    <div class="card @if (!$loop->last) mb-3 @endif">
                                                        <div class="card-header">{{ $question->question_text }}</div>

                                                        <div class="card-body">
                                                            <input type="hidden" name="questions[{{ $question->id }}]" value="">
                                                            @foreach ($question->questionOptions as $option)
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="questions[{{ $question->id }}]"
                                                                        id="option-{{ $option->id }}"
                                                                        value="{{ $option->id }}"@if (old("questions.$question->id") == $option->id) checked @endif>
                                                                    <label class="form-check-label" for="option-{{ $option->id }}">
                                                                        {{ $option->option_text }}
                                                                    </label>
                                                                </div>
                                                            @endforeach

                                                            @if ($errors->has("questions.$question->id"))
                                                                <span style="margin-top: .25rem; font-size: 80%; color: #e3342f;" role="alert">
                                                                    <strong>{{ $errors->first("questions.$question->id") }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="mt-4">
                                                    <label for="formFile" class="form-label">Masukan file bukti</label>
                                                    <input class="form-control" type="file" id="formFile"
                                                        name="attachment[{{ $category->id }}]">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0 mt-3">
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-primary" name="aksi" value="simpan">
                                                    Simpan
                                                </button>
                                                <button type="submit" class="btn btn-secondary" name="aksi" value="kirim">
                                                    Kirim Hasil
                                                </button>
                                            </div>
                                            <div class="col-md-6">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
