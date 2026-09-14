@extends('layout.project.master')

@section('title', 'پروژه‌ها')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">پروژه‌ها</h1>
        <a href="{{ route('projects.create') }}" class="btn btn-primary">پروژه جدید</a>
    </div>
    <div class="row border-end pe-4 me-3">
        @foreach($projects as $project)
            <a href="#" class="row border rounded-3 mt-4 align-items-center text-black link-item-pishnevis py-2 py-md-0">
                <div class="col-md-1 text-center m-0 p-0">
                    <img src="{{url('assets/icon/list/avatar.svg')}}" width="58" height="59" />
                </div>
                <div class="col-md-11">
                    <div class="row border-bottom pt-3 pb-2">
                        <div class="col-md-7 d-flex justify-content-between">
                            <h6 class="fw-bold m-0">{{$project->title}}</h6>
                        </div>
                        <div class="col-md-5 d-flex justify-content-md-end">
                            <p class="m-0">تعداد برد‌ها:</p>
                            <span class="text-red-number me-2">مقدار نمایش یک</span>
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col-md-6 d-flex">
                            <h6 class="m-0">عنوان نمایش دو:</h6>
                            <span class="text-red-number me-2">مقدار نمایش دو</span>
                        </div>
                        <div class="col-md-6 d-flex justify-content-md-end">
                            <p class="m-0">عنوان نمایش سه:</p>
                            <span class="text-red-number me-2">مقدار نمایش سه</span>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
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
