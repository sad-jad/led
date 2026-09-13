@extends('layout.app')

@section('title', 'پروژه‌ها')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">پروژه‌ها</h1>
        <a href="{{ route('projects.create') }}" class="btn btn-primary">پروژه جدید</a>
    </div>

    <table class="table bg-white">
        <thead>
            <tr>
                <th>عنوان</th>
                <th>تعداد بردها</th>
                <th class="text-end">عملیات</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($projects as $project)
                <tr>
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->boards_count }}</td>
                    <td class="text-end">
                        <a href="{{ route('projects.edit', $project) }}" class="btn btn-sm btn-outline-secondary">ویرایش</a>
                        <form action="{{ route('projects.destroy', $project) }}" method="POST" class="d-inline" onsubmit="return confirm('حذف این پروژه؟')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">حذف</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-muted">هنوز هیچ پروژه‌ای ثبت نشده است.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
