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
                    <h1 class="h3 mb-0 text-gray-800">{{ __('edit category') }}</h1>
                    <a href="{{ route('admin.categories.index') }}"
                        class="btn btn-primary btn-sm shadow-sm">{{ __('Go Back') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="name">name</label>
                        <input type="text" class="form-control" id="name" placeholder="name" name="name"
                            value="{{ old('name', $category->name) }}" />
                    </div>
                    <div class="form-group">
                        <label for="info">Informasi file bukti</label>
                        <input type="text" class="form-control" id="info" placeholder="bukti berupa dokumen peserta didik" name="info"
                            value="{{ old('info', $category->info) }}" />
                    </div>
                    <hr>
                    <p>Rentang Nilai</p>
                    @foreach ($feedbacks as $index => $feedback)
                        <div class="row">
                            <div class="form-group col-2">
                                <label for="score{{ $index }}">{{ __('Kategori Nilai') }}</label>
                                <input type="text" class="form-control" id="score{{ $index }}"
                                    placeholder="{{ __('A') }}" name="score[]"
                                    value="{{ old('score.' . $index, $feedback->score) }}" />
                            </div>
                            <div class="form-group col-2">
                                <label for="min{{ $index }}">{{ __('Nilai Minimal') }}</label>
                                <input type="number" class="form-control" id="min{{ $index }}"
                                    placeholder="{{ __('0') }}" name="min[]"
                                    value="{{ old('min.' . $index, $feedback->min) }}" />
                            </div>
                            <div class="form-group col-2">
                                <label for="max{{ $index }}">{{ __('Nilai Maksimal') }}</label>
                                <input type="number" class="form-control" id="max{{ $index }}"
                                    placeholder="{{ __('0') }}" name="max[]"
                                    value="{{ old('max.' . $index, $feedback->max) }}" />
                            </div>
                            <div class="form-group col-6">
                                <label for="feedback{{ $index }}">{{ __('Feedback') }}</label>
                                <input type="text" class="form-control" id="feedback{{ $index }}"
                                    placeholder="{{ __('Masukkan Feedback Nilai') }}" name="feedback[]"
                                    value="{{ old('feedback.' . $index, $feedback->feedback) }}" />
                            </div>
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Save') }}</button>
                </form>
            </div>
        </div>


        <!-- Content Row -->

    </div>
@endsection
