@extends('layouts.app')

@section('content')
<p class="text-center fs-6 mt-2 fs-1 fw-bold">Cadangan Aktiviti<br></p>
<div class="container overflow-auto">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body scroll">
                        <div class ="text-center mb-5">
                            <strong>Lengkapkan semua butiran di bawah. </strong><br>
                        </div>
                        {!! Form::open(['class' => "row g-3",'action' => '\App\Http\Controllers\AktivitiController@store', 'method'=>'POST','enctype' => 'multipart/form-data']) !!}
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Emel PRIP') }}</label>
                            <div class="col-md-6">
                                <input id="pensyarah" type="email" class="form-control" name="pensyarah" placeholder="Emel pensyarah rujukan..." value="{{$email}}"required>
                            </div>
                        </div>
                        <div class="row mb-3 mt-3">
                            <label for="nama" class="col-md-4 col-form-label text-md-end">{{ __('Nama') }}</label>
                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control" name="nama" placeholder="Nama anda..." value="{{$user->name}}"  required>
                            </div>
                        </div>
                        <div class="row mb-3 ">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('No telefon') }}</label>
                            <div class="col-md-6">
                                <input id="no_telefon" type="text" class="form-control" name="no_telefon" value="{{$user->telefon}}" placeholder="Nombor telefon yang boleh dihubungi..." required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Institusi') }}</label>
                            <div class="col-md-6">
                                <input id="institusi" type="text" class="form-control" name="institusi" placeholder="Institusi mengajar..." value="{{$user->polikk}}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Butiran Aktiviti') }}</label>
                            <div class="col-md-6">
                                <textarea id="cadangan_aktiviti" class="form-control" maxlength="150" rows="4" name="cadangan_aktiviti" placeholder="Butiran aktiviti yang dicadangkan..." required></textarea>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary fw-bold">Hantar</button>
                            </div>
                        </div>
                        {!! Form::close() !!} 
                </div>
            </div>
        </div>
    </div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
</script>
<script type="text/javascript">
    var route = "{{ url('autocomplete-search') }}";
    $('#pensyarah').typeahead({
        source: function (query, process) {
            return $.get(route, {
                query: query
            }, function (data) {
                return process(data);
            });
        }
    });
</script>
@endsection
