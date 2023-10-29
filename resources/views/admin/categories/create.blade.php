@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Content Row -->
    <div class="card shadow">
        <div class="card-header">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">{{ __('Create Category') }}</h1>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-primary btn-sm shadow-sm">{{ __('Go Back') }}</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">{{ __('Kategori') }}</label>
                    <input type="text" class="form-control" id="name" placeholder="{{ __('') }}" name="name" value="{{ old('name') }}" />
                </div>
                <div class="form-group">
                    <label for="name">{{ __('Informasi file bukti') }}</label>
                    <input type="text" class="form-control" id="info" placeholder="{{ __('') }}" name="info" value="{{ old('info') }}" />
                </div>
                <hr>
                <p>Rentang Nilai</p>
                @for ($i = 0; $i < 4; $i++)
                <div class="row">
                    <div class="form-group col-2">
                        <label for="score{{ $i }}">{{ __('Kategori Nilai') }}</label>
                        <input type="text" class="form-control" id="score{{ $i }}" placeholder="{{ __('A') }}" name="score[]" value="{{ old('score.' . $i) }}" />
                    </div>
                    <div class="form-group col-2">
                        <label for="min{{ $i }}">{{ __('Nilai Minimal') }}</label>
                        <input type="number" class="form-control" id="min{{ $i }}" placeholder="{{ __('0') }}" name="min[]" value="{{ old('min.' . $i) }}" />
                    </div>
                    <div class="form-group col-2">
                        <label for="max{{ $i }}">{{ __('Nilai Maksimal') }}</label>
                        <input type="number" class="form-control" id="max{{ $i }}" placeholder="{{ __('0') }}" name="max[]" value="{{ old('max.' . $i) }}" />
                    </div>
                    <div class="form-group col-6">
                        <label for="feedback{{ $i }}">{{ __('Feedback') }}</label>
                        <input type="text" class="form-control" id="feedback{{ $i }}" placeholder="{{ __('Masukkan Feedback Nilai') }}" name="feedback[]" value="{{ old('feedback.' . $i) }}" />
                    </div>
                </div>
                @endfor

                <button type="submit" class="btn btn-primary btn-block">{{ __('Save') }}</button>
            </form>
        </div>
    </div>

    <!-- Content Row -->

</div>
@endsection
