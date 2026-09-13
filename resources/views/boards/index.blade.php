@extends('layout.app')

@section('title', 'بردها')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">بردها</h1>
        <a href="{{ route('boards.create') }}" class="btn btn-primary">برد جدید</a>
    </div>

    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-3">
        @forelse ($boards as $board)
            <div class="col">
                <div class="card h-100">
                    @php($image = $board->featuredImage())
                    <img src="{{ $image ? Storage::url($image->path) : 'https://placehold.co/300x200?text=' . urlencode($board->name) }}"
                         class="card-img-top" style="height: 160px; object-fit: cover;" alt="{{ $board->name }}">
                    <div class="card-body">
                        <h2 class="h6 card-title mb-1">{{ $board->name }}</h2>
                        <p class="card-text text-muted small mb-2">{{ $board->type }}</p>
                        <div class="d-flex gap-2">
                            <a href="{{ route('boards.edit', $board) }}" class="btn btn-sm btn-outline-secondary">ویرایش</a>
                            <form action="{{ route('boards.destroy', $board) }}" method="POST" onsubmit="return confirm('حذف این برد؟')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">حذف</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">هنوز هیچ بردی ثبت نشده است.</p>
        @endforelse
    </div>
@endsection
