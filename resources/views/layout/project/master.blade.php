<!DOCTYPE html>
<html dir="rtl" lang="en">
@include('layout.project.section.head')
<body>
    <section class="profile bg-white py-4">
        <div class="container">
            <div class="row g-3 px-md-4">
                <div class="col-lg-3 order-1 order-lg-0">
                    @include('layout.project.section.sidebar')
                </div>
                <div class="col-lg-9 order-0 order-lg-1">
                    @include('layout.project.section.alert')
                    @include('layout.project.section.error')
                    @yield('content')
                </div>
            </div>
        </div>
    </section>
@include('layout.project.section.script')
</body>
</html>