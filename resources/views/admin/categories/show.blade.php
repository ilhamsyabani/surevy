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
                    <a href="{{ route('admin.categories.index') }}"
                        class="btn btn-primary btn-sm shadow-sm">{{ __('Go Back') }}</a>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">{{ __('Kategori') }}</label>
                    <p>{{ $category->name}}</p>
                </div>
                <hr>
                <p>Keterangan dokumen : {{ $category->info }}</p>
                <p>Rentang Nilai</p>
                <table class="table table-bordered table-striped table-hover datatable datatable-category" cellspacing="0"
                    width="100%">
                    <thead>
                        <tr>
                            <th width="10">
                            </th>
                            <th>Score</th>
                            <th>min</th>
                            <th>max</th>
                            <th>feedback</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($category->categoryFeedback as $feedback)
                            <tr data-entry-id="{{ $category->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $feedback->score }}</td>
                                <td>{{ $feedback->min }}</td>
                                <td>{{ $feedback->max }}</td>
                                <td>{{ $feedback->feedback }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-info">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>
                                        <a href="{{ route('admin.categories.show', $category->id) }}" class="btn btn-info">
                                            show</i>
                                        </a>
                                        <form onclick="return confirm('are you sure ? ')" class="d-inline" action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger" style="border-top-left-radius: 0;border-bottom-left-radius: 0;">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">{{ __('Data Empty') }}</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>

        <!-- Content Row -->

    </div>
@endsection
