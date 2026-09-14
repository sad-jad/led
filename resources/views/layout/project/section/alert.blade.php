@if (session()->has('alert-success'))
    <div class="alert alert-success alert-dismissible">
        <ul>
            <li>{{ session('alert-success') }}</li>
        </ul>
    </div>
    {{ session()->forget('alert-success') }}
@endif
@if (session()->has('alert-error'))
    <div class="alert alert-danger alert-dismissible">
        <ul>
            <li>{{ session('alert-error') }}</li>
        </ul>
    </div>
    {{ session()->forget('alert-error') }}
@endif