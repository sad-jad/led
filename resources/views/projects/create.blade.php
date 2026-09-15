@extends('layout.project.master')

@section('title', 'پروژه جدید')

@section('content')
    <h1 class="h4 mb-3">پروژه جدید</h1>
    <form action="{{ route('projects.store') }}" method="POST" class="col-lg-6">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">عنوان پروژه</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                   value="{{ old('title') }}" required autofocus>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">ایجاد و افزودن بردها</button>
    </form>
@endsection
