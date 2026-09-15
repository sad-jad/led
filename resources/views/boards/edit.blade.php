@extends('layout.project.master')

@section('title', 'ویرایش برد')

@section('content')
    <h1 class="h4 mb-3">ویرایش برد: {{ $board->name }}</h1>

    <form action="{{ route('board.update', $board) }}" method="POST" enctype="multipart/form-data" class="col-lg-6">
        @csrf
        @method('PUT')
        @include('boards._form')
        <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
    </form>
@endsection
