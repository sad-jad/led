@extends('layout.project.master')

@section('title', 'برد جدید')

@section('content')
    <h1 class="h4 mb-3">برد جدید</h1>

    <form action="{{ route('board.store') }}" method="POST" enctype="multipart/form-data" class="col-lg-6">
        @csrf
        @include('boards._form')
        <button type="submit" class="btn btn-primary">ثبت برد</button>
    </form>
@endsection
