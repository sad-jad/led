@if ($errors->any())
    <div class="alert alert-danger alert-dismissible">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if($masseage=session('success'))
    <div class="alert alert-success alert-dismissible">
        {{$masseage}}
        {{session()->forget('masseage')}}
    </div>
@endif
@if($masseage=session('error'))
    <div class="alert alert-danger">
        <h4 style="text-align: center">  {{$masseage}}</h4>
        {{session()->forget('masseage')}}
    </div>
@endif