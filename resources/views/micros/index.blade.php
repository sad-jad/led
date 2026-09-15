@extends('layout.project.master')

@section('title', 'میکروها')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">میکروها</h1>
        <a href="{{ route('micro.create') }}" class="btn btn-primary">میکرو جدید</a>
    </div>

    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-3">
        @forelse ($micros as $micro)
            <div class="col">
                <div class="card h-100">
                    <img src="{{ $micro->icon() ? url($micro->icon()->path) : url('assets/img/micro/default.png') }}"
                         class="card-img-top" style="height: 160px; object-fit: cover;" alt="{{ $micro->name }}">
                    <div class="card-body">
                        <h2 class="h6 card-title mb-1">{{ $micro->name }}</h2>
                        <p class="card-text text-muted small mb-2">{{ $micro->type }}</p>
                        <div class="d-flex gap-2">
                            <a href="{{ route('micro.edit', $micro) }}" class="btn btn-sm btn-outline-secondary">ویرایش</a>
                            <form action="{{ route('micro.destroy', $micro) }}" method="POST" onsubmit="return confirm('حذف این میکرو؟')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">حذف</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">هنوز هیچ میکرویی ثبت نشده است.</p>
        @endforelse
    </div>
@endsection
