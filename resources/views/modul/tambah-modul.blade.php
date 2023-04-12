@extends('layouts.app')
@section('content')

<p class="text-center fs-6 mt-2 fs-1 fw-bold">Tambah Modul<br></p>
<div class="container overflow-auto">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body scroll">
                        <div class ="text-center mb-5">
                            <strong>Lengkapkan semua butiran di bawah. </strong><br>
                        </div>

                        {!! Form::open(['class' => "row g-3",'action' => '\App\Http\Controllers\ModulController@store', 'method'=>'POST','enctype' => 'multipart/form-data']) !!}
                        @csrf

                        <div class="row mb-3">
                            <label for="nama" class="col-md-4 col-form-label text-md-end">{{ __('Modul') }}</label>
                            <div class="col-md-6">
                                <select id="nama" class="form-select" name="nama" >
                                    <option value="Modul 1">Modul 1</option>
                                    <option value="Modul 2">Modul 2</option>
                                    <option value="Modul 3">Modul 3</option>
                                    <option value="Modul 4">Modul 4</option>
                                    <option value="Modul 5">Modul 5</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="butiran" class="col-md-4 col-form-label text-md-end">{{ __('Butiran Modul ') }}</label>
                            <div class="col-md-6">
                                <textarea id="butiran" class="form-control" name="butiran" placeholder="Butiran modul..." required></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tarikh_mula" class="col-md-4 col-form-label text-md-end">{{ __('Tarikh Mula') }}</label>
                            <div class="col-md-6">
                                <input id="tarikh_mula" type="date" class="form-control" name="tarikh_mula" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tarikh_tamat" class="col-md-4 col-form-label text-md-end">{{ __('Tarikh Tamat') }}</label>
                            <div class="col-md-6">
                                <input id="tarikh_tamat" type="date" class="form-control" name="tarikh_tamat" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tempat" class="col-md-4 col-form-label text-md-end">{{ __('Tempat ') }}</label>
                            <div class="col-md-6">
                                <input id="tempat" type="text" class="form-control" name="tempat" placeholder="Contoh: DK1, Politeknik Ibrahim Sultan" required>
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

<script>
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
</script>
<script type="text/javascript">
    var route = "{{ url('autocomplete-search') }}";
    $('#emel').typeahead({
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
