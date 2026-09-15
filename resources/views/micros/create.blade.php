@extends('layout.project.master')

@section('title', 'میکرو جدید')

@section('content')
    <h1 class="h4 mb-3">میکرو جدید</h1>

    <form action="{{ route('micro.store') }}" method="POST" enctype="multipart/form-data" class="col-lg-6">
        @csrf
        @include('micros._form')
        <button type="submit" class="btn btn-primary">ثبت میکرو</button>
    </form>
@endsection
