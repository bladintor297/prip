@extends('layouts.app')

@section('content')
<p class="text-center fs-6 mt-2 fs-1 fw-bold">Tambah Aktiviti<br></p>
<div class="container overflow-auto">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body scroll">
                        <div class ="text-center mb-5">
                            <strong>Lengkapkan semua butiran di bawah. </strong><br>

                            {{-- @if (Session::get('role') === '2')
                                <strong>Anda juga boleh melihat senarai cadangan aktiviti
                                    <a class="badge bg-primary text-decoration-none text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">di sini</a>
                                </strong>
                            @endif --}}
                        </div>
                        @if (Session::get('role') === '2')
                        <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title fw-bold" id="offcanvasScrollingLabel">Permohonan Aktiviti</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            @foreach ($cadangans as $cadangan)
                            <div class="card mb-2">
                                <div class="card-header">
                                    {{$cadangan->nama}}
                                </div>
                                <div class="card-body">
                                    <blockquote class="blockquote mb-0">
                                    <p>{{$cadangan->cadangan_aktiviti}}</p>
                                    <footer class="blockquote-footer fs-6">{{$cadangan->daripada}} <cite title="Source Title">({{$cadangan->no_telefon}})</cite></footer>
                                    </blockquote>
                                </div>
                                <div class="card-footer">
                                    <div class="d-flex justify-content-end gap-1">
                                        <a class="btn btn-success fw-bold" href="/terima/{{$cadangan->id}}" style="font-size: 10px;">Terima</a>
                                        <a class="btn btn-danger fw-bold" href="/tolak/{{$cadangan->id}}" style="font-size: 10px;">Tolak</a>
                                    </div>
                                </div>

                            </div>
                            @endforeach
                            
                        </div>
                        </div>
                        @endif

                        {!! Form::open(['class' => "row g-3",'action' => '\App\Http\Controllers\AktivitiController@store', 'method'=>'POST','enctype' => 'multipart/form-data']) !!}
                        @csrf

                        @if(Session::get('role')==='1')
                            <div class="row mb-3">
                                <label for="nama_aktiviti" class="col-md-4 col-form-label text-md-end">{{ __('Emel PRIP') }}</label>
                                <div class="col-md-6">
                                    <input id="emel" type="text" class="form-control" name="emel" placeholder="Emel PRIP..." required>
                                </div>
                            </div>
                        @endif
                        <div class="row mb-3">
                            <label for="nama_aktiviti" class="col-md-4 col-form-label text-md-end">{{ __('Nama Aktiviti') }}</label>
                            <div class="col-md-6">
                                <input id="nama_aktiviti" type="text" class="form-control" name="nama_aktiviti" placeholder="Nama aktiviti..." required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="butiran_aktiviti" class="col-md-4 col-form-label text-md-end">{{ __('Butiran Aktiviti') }}</label>
                            <div class="col-md-6">
                                <textarea id="butiran_aktiviti" class="form-control" rows="3" maxlength="300" name="butiran_aktiviti" placeholder="Butiran aktiviti..." required></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tarikh_mula" class="col-md-4 col-form-label text-md-end">{{ __('Tarikh Mula') }}</label>
                            <div class="col-md-6">
                                <input id="tarikh_mula" type="date" class="form-control" name="tarikh_mula" placeholder="Butiran aktiviti..." required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tarikh_akhir" class="col-md-4 col-form-label text-md-end">{{ __('Tarikh Akhir') }}</label>
                            <div class="col-md-6">
                                <input id="tarikh_akhir" type="date" class="form-control" name="tarikh_akhir" placeholder="Butiran aktiviti..." required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tempat" class="col-md-4 col-form-label text-md-end">{{ __('Tempat ') }}<a href="#" data-toggle="tooltip" title="Jika aktiviti dijalankan secara maya, nyatakan platform yang digunakan, cth: Google Meet"><i class="fa-solid fa-circle-info"></i></a></label>
                            <div class="col-md-6">
                                <input id="tempat" type="text" class="form-control" name="tempat" placeholder="Contoh: Dewan Utama, Politeknik Ibrahim Sultan" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="bil_peserta" class="col-md-4 col-form-label text-md-end">{{ __('Bilangan Peserta ') }}</label>
                            <div class="col-md-6">
                                <input id="bil_peserta" type="number" class="form-control" name="bil_peserta" value="0" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="institusi" class="col-md-4 col-form-label text-md-end">{{ __('Institusi Terlibat') }}</label>
                            <div class="col-md-6">
                                <textarea id="institusi" class="form-control" rows="4" name="institusi" placeholder="Contoh: Politeknik Merlimau, Politeknik Ibrahim Sultan, Kolej Komuniti Pasir Gudang..." required></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="gambar_aktiviti" class="col-md-4 col-form-label text-md-end">{{ __('Gambar aktiviti (Pilih satu)') }}</label>
                            <div class="col-md-6">
                                <input type='file' id="getFile" class="form-control" name="gambar" accept=".png, .jpg, .jpeg"  required>
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
