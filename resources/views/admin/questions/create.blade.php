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
                    <h1 class="h3 mb-0 text-gray-800">{{ __('create question') }}</h1>
                    <a href="{{ route('admin.questions.index') }}" class="btn btn-primary btn-sm shadow-sm">{{ __('Go Back') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.questions.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="category">{{ __('Category') }}</label>
                        <select class="form-control" name="category_id" id="category">
                            @foreach($categories as $id => $category)
                                <option value="{{ $id }}">{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="question_text">{{ __('question text') }}</label>
                        <input type="text" class="form-control" id="question_text" placeholder="{{ __('question text') }}" name="question_text" value="{{ old('question_text') }}" />
                    </div>
                    <div class="form-group">
                        <label for="option_text">{{ __('Sekla 1') }}</label>
                        <input type="text" class="form-control" id="option_text1" placeholder="{{ __('option text') }}" name="option_text[]" value="{{ old('option_text') }}" />
                        <input type="hidden" class="form-control" id="points" placeholder="{{ __('option text') }}" name="point[]" value="1" />
                        <div id="emailHelp" class="form-text">pilihan ini bernilai 1 dari sekala 1 sampai 4</div>
                    </div>
                    <div class="form-group">
                        <label for="option_text">{{ __('Sekla 2') }}</label>
                        <input type="text" class="form-control" id="option_text2" placeholder="{{ __('option text') }}" name="option_text[]" value="{{ old('option_text') }}" />
                        <input type="hidden" class="form-control" id="points" placeholder="{{ __('option text') }}" name="point[]" value="2" />
                        <div id="emailHelp" class="form-text">pilihan ini bernilai 2 dari sekala 1 sampai 4</div>
                    </div>
                    <div class="form-group">
                        <label for="option_text">{{ __('Sekla 3') }}</label>
                        <input type="text" class="form-control" id="option_text3" placeholder="{{ __('option text') }}" name="option_text[]" value="{{ old('option_text') }}" />
                        <input type="hidden" class="form-control" id="points" placeholder="{{ __('option text') }}" name="point[]" value="3" />
                        <div id="emailHelp" class="form-text">pilihan ini bernilai 3 dari sekala 1 sampai 4</div>
                    </div>
                    <div class="form-group">
                        <label for="option_text">{{ __('Sekla 4') }}</label>
                        <input type="text" class="form-control" id="option_text4" placeholder="{{ __('option text') }}" name="option_text[]" value="{{ old('option_text') }}" />
                        <input type="hidden" class="form-control" id="points" placeholder="{{ __('option text') }}" name="point[]" value="4" />
                        <div id="emailHelp" class="form-text">pilihan ini bernilai 4 dari sekala 1 sampai 4</div>
                    </div>
                    {{-- <div class="form-group">
                        <label for="points">{{ __('points') }}</label>
                        <input type="number" class="form-control" id="points" placeholder="{{ __('option text') }}" name="points" value="{{ old('points') }}" />
                    </div> --}}
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Save') }}</button>
                </form>
            </div>
        </div>
    

    <!-- Content Row -->

</div>
@endsection