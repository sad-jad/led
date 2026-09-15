<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'مدیریت پروژه‌ها')</title>
    <link rel="stylesheet" href="{{ asset('assets/library/bootstrap/bootstrap.min.css') }}">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('project.index') }}">مدیریت پروژه</a>
            <div class="navbar-nav">
                <a class="nav-link {{ request()->routeIs('project.*') ? 'active' : '' }}" href="{{ route('project.index') }}">پروژه‌ها</a>
                <a class="nav-link {{ request()->routeIs('board.*') ? 'active' : '' }}" href="{{ route('board.index') }}">بردها</a>
                <a class="nav-link {{ request()->routeIs('micro.*') ? 'active' : '' }}" href="{{ route('micro.index') }}">میکروها</a>
            </div>
        </div>
    </nav>

    <div class="container pb-5">
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        @yield('content')
    </div>

    <script src="{{ asset('assets/library/jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/library/bootstrap/bootstrap.bundle.min.js') }}"></script>
    @yield('scripts')
</body>
</html>
