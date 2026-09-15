@extends('layout.project.master')

@section('title', 'پروژه‌ها')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">پروژه‌ها</h1>
        <a href="{{ route('project.create') }}" class="btn btn-primary">پروژه جدید</a>
    </div>

    @foreach($projects as $project)
        <div class="row border rounded-2 align-items-center mt-3 m-0 p-3">
        <div class="col-md-7">
                <div>
                    <h6 class="fw-bold text-sorme">{{$project->title}}</h6>
                    <span class="d-flex">
                        <img src="{{url('assets/icon/list/request.svg')}}" width="15" height="14" />
                        <span class="text-gray fs-12">{{ $project->user->name }}</span>
                    </span>
                </div>
            </div>
            <div class="col-md-5">
                <div class="d-flex justify-content-end align-items-center mt-3 mt-md-0">
                    @foreach($project->boards as $board)
                        <div class="users-contracts d-flex justify-content-center ">
                            @php($boardIcon = $board->icon())
                            <img class="rounded-5" width="28"  src="{{ $boardIcon ? url($boardIcon->path) : url('assets/img/board/default.png') }}" alt="img">
                            <div class="hover-user shadow rounded-3 p-3">
                                <div class="d-md-flex align-items-center">
                                    <div>
                                        @php($microIcon = $board->micro->icon())
                                        <img class="rounded-3" width="60" height="60" src="{{ $microIcon ? url($microIcon->path) : url('assets/img/micro/default.png') }}">
                                    </div>
                                    <div class="me-3">
                                        <h6 class="fw-bold">{{$board->name}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <a href="{{ route('project.edit', $project) }}" class=" d-block me-5">
                        <img src="{{url('assets/library/shadonic/icons/left-arrow.svg')}}" width="16" height="20" />
                    </a>
                </div>
            </div>
        </div>
    @endforeach
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
                        <a href="{{ route('project.edit', $project) }}" class="btn btn-sm btn-outline-secondary">ویرایش</a>
                        <form action="{{ route('project.destroy', $project) }}" method="POST" class="d-inline" onsubmit="return confirm('حذف این پروژه؟')">
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
