@if(count($errors) > 0)
    @foreach($errors->all() as $error)
    <div class="container w-50 mt-3">
        <div class="alert alert-danger ">
            {{$error}}
        </div>
    </div>
    @endforeach
@endif

@if(session('success'))
    <div class="container w-50 mt-3">
        <div class="alert alert-success">
        {{session('success')}}
    </div>
    </div>
@endif

@if(session('error'))
    <div class="container w-50 mt-3">
        <div class="alert alert-danger ">
            {{session('error')}}
        </div>
    </div>
@endif