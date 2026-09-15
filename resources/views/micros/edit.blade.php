@extends('layout.project.master')

@section('title', 'ویرایش میکرو')

@section('content')
    <h1 class="h4 mb-3">ویرایش میکرو: {{ $micro->name }}</h1>

    <form action="{{ route('micro.update', $micro) }}" method="POST" enctype="multipart/form-data" class="col-lg-6">
        @csrf
        @method('PUT')
        @include('micros._form')
        <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
    </form>
@endsection
