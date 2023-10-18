@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<!-- Content Row -->
        <div class="card shadow">
            <div class="card-header">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">{{ __('edit question')}}</h1>
                    <a href="{{ route('admin.questions.index') }}" class="btn btn-primary btn-sm shadow-sm">{{ __('Go Back') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.questions.update', $question->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="question_text">{{ __('question text') }}</label>
                        <input type="text" class="form-control" id="question_text" placeholder="{{ __('question text') }}" name="question_text" value="{{ old('question_text', $question->question_text) }}" />
                    </div>
                    <div class="form-group">
                        <label for="category">{{ __('Category') }}</label>
                        <select class="form-control"  name="category_id" id="category">
                            @foreach($categories as $id => $category)
                                <option {{ $id == $question->category->id ? 'selected' : null }} value="{{ $id }}">{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        @foreach($options as $index => $option)
                            <label for="option_text{{ $index + 1 }}">{{ __('Sekla ' . ($index + 1)) }}</label>
                            <input type="text" class="form-control" id="option_text{{ $index + 1 }}" placeholder="{{ __('option text') }}" name="option_text[]" value="{{ old('option_text', $option->option_text) }}" />
                            <input type="hidden" class="form-control" id="points{{ $index + 1 }}" name="point[]" value="{{ $index + 1 }}" />
                            <div id="emailHelp" class="form-text">pilihan ini bernilai {{ $index + 1 }} dari sekala 1 sampai 4</div>
                        @endforeach
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Update')}}</button>
                </form>
            </div>
        </div>
    

    <!-- Content Row -->

</div>
@endsection