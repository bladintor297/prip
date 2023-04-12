@extends('layouts.app')

@section('content')
<p class="text-center fs-6 mt-2 fs-1 fw-bold">
    
    @if ($user->role === '2')
    Profil Pensyarah
        
    @else
    Profil Pengguna
        
    @endif
    
    <br></p>
<div class="container overflow-auto">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body scroll">
                        <div class ="text-center mb-5">
                            <strong>Lengkapkan semua butiran di bawah. </strong>
                        </div>
                        {!! Form::open(['class' => "row g-3", 'action' => ['\App\Http\Controllers\AdminController@update', $user->id], 'method'=>'POST','enctype' => 'multipart/form-data']) !!}
                        @csrf

                        <div class="row mb-2">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Emel') }}</label>
                            <div class="col-md-6">
                                <input oninput="this.value = this.value.toUpperCase()"  id="pensyarah" type="email" class="form-control" name="pensyarah" value="{{$user->email}}" disabled>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="nama" class="col-md-4 col-form-label text-md-end">{{ __('Nama') }}</label>
                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control" name="nama" placeholder="Nama penuh seperti dalam K/P" value="{{$user->name}}"  required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="no_kp" class="col-md-4 col-form-label text-md-end">{{ __('No K/P') }}</label>
                            <div class="col-md-6">
                                <input id="no_kp" type="text" class="form-control" name="no_kp" placeholder="No kad pengenalan" value="{{$user->no_kp}}"  required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="telefon" class="col-md-4 col-form-label text-md-end">{{ __('No telefon') }}</label>
                            <div class="col-md-6">
                                <input id="telefon" type="text" class="form-control" name="telefon" placeholder="No telefon " value="{{$user->telefon}}"  required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="gred" class="col-md-4 col-form-label text-md-end">{{ __('Gred') }}</label>
                            <div class="col-md-6">
                                <div class="col-md-6">
                                    {{Form::select('gred', [
                                        'DH29' => 'DH29',
                                        'DH32' => 'DH32',
                                        'DH34' => 'DH34',
                                        'DH36' => 'DH36',
                                        'DH40' => 'DH40',
                                        'DH41' => 'DH41',
                                        'DH42' => 'DH42',
                                        'DH44' => 'DH44',
                                        'DH48' => 'DH48',
                                        'DH52' => 'DH52',
                                        'DH54' => 'DH54',
                                        'Jusa C' => 'Jusa C',
                                        'Jusa B' => 'Jusa B',
                                        
                                    ], $user->gred, ['class'=> 'form-select', 'id' => 'gred']);}}
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2 ">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Bidang Pengajaran') }}</label>
                            <div class="col-md-6">
                                {{Form::select('bidang', [
                                    'KEJURUTERAAN MEKANIKAL' => 'KEJURUTERAAN MEKANIKAL',
                                    'KEJURUTERAAN ELEKTRIKAL' => 'KEJURUTERAAN ELEKTRIKAL',
                                    'KEJURUTERAAN AWAM & ALAM BINA' => 'KEJURUTERAAN AWAM & ALAM BINA',
                                    'REKA BENTUK & KREATIF' => 'REKA BENTUK & KREATIF',
                                    'HOSPITALITI & PELANCONGAN' => 'HOSPITALITI & PELANCONGAN',
                                    'PENGURUSAN & PERDAGANGAN' => 'PENGURUSAN & PERDAGANGAN',
                                    'TEKNOLOGI PERTANIAN' => 'TEKNOLOGI PERTANIAN',
                                    'PERKOMPUTERAN' => 'PERKOMPUTERAN',
                                    'PENGAJIAN PERKHIDMATAN' => 'PENGAJIAN PERKHIDMATAN',
                                    'PENGAJIAN UMUM' => 'PENGAJIAN UMUM',
                                ], $user->bidang, ['class'=> 'form-select', 'id' => 'bidang']);}}
                            </div>
                        </div>
                        <div class="row mb-2 ">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Program Pengajian') }}</label>
                            <div class="col-md-6">
                                <input id="program" type="text" class="form-control" name="program" value="{{$user->program}}" placeholder="Program pengajian..." required>
                            </div>
                        </div>
                        <div class="row mb-2 ">
                            <label for="polikk" class="col-md-4 col-form-label text-md-end">{{ __('Institut Pengajian') }}</label>
                            <div class="col-md-6">
                                <input id="polikk" type="text" class="form-control" name="polikk" value="{{$user->polikk}}" placeholder="Institut Pengajian..." required>
                            </div>
                        </div>
                        <div class="row mb-2 ">
                            <label for="negeri" class="col-md-4 col-form-label text-md-end">{{ __('Negeri') }}</label>
                            <div class="col-md-6">
                                {{Form::select('negeri', [
                                    'Johor'=>'Johor',
                                    'Kedah'=>'Kedah',
                                    'Kelantan'=>'Kelantan',
                                    'Melaka'=>'Melaka',
                                    'Negeri Sembilan'=>'Negeri Sembilan',
                                    'Pahang'=>'Pahang',
                                    'Perak'=>'Perak',
                                    'Perlis'=>'Perlis',
                                    'Pulau Pinang'=>'Pulau Pinang',
                                    'Sabah'=>'Sabah',
                                    'Sarawak'=>'Sarawak',
                                    'Selangor'=>'Selangor',
                                    'Terengganu'=>'Terengganu',
                                    'Wilayah Persekutuan Kuala Lumpur'=>'Wilayah Persekutuan Kuala Lumpur',
                                    'Wilayah Persekutuan Labuan'=>'Wilayah Persekutuan Labuan',
                                    'Wilayah Persekutuan Putrajaya'=>'Wilayah Persekutuan Putrajaya',
                                ], $user->negeri, ['class'=> 'form-select text-uppercase', 'id' => 'negeri']);}}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="emel_google" class="col-md-4 col-form-label text-md-end">{{ __('Emel google') }}</label>
                            <div class="col-md-6">
                                <input id="emel_google" type="email" class="form-control" name="emel_google" placeholder="Emel alternatif @google.com" value="{{$user->emel_google}}" >
                            </div>
                        </div>
                        @if ($user->role === '2')
                        <div class="row mb-2 ">
                            <label for="sesi_lantikan" class="col-md-4 col-form-label text-md-end">{{ __('Sesi Lantikan PRIP') }}</label>
                            <div class="col-md-3">
                                {{Form::select('bulan_lantikan', [
                                    '01' => 'Januari',
                                    '02' => 'Februari',
                                    '03' => 'Mac',
                                    '04' => 'April',
                                    '05' => 'Mei',
                                    '06' => 'Jun',
                                    '07' => 'Julai',
                                    '08' => 'Ogos',
                                    '09' => 'September',
                                    '10' => 'October',
                                    '11' => 'November',
                                    '12' => 'Disember',
                                ], $user->bulan_lantikan, ['class'=> 'form-select text-uppercase', 'id' => 'bulan_lantikan', 'disabled']);}}
                            </div>
                            <div class="col-md-3">
                                {{Form::select('tahun_lantikan', [
                                    ($user->tahun_lantikan - 2) => ($user->tahun_lantikan - 2),
                                    ($user->tahun_lantikan - 1) => ($user->tahun_lantikan - 1),
                                    ($user->tahun_lantikan) => ($user->tahun_lantikan),
                                    ($user->tahun_lantikan + 1) => ($user->tahun_lantikan + 1),
                                    ($user->tahun_lantikan + 2) => ($user->tahun_lantikan + 2),
                                    ($user->tahun_lantikan + 3) => ($user->tahun_lantikan + 3),
                                    ($user->tahun_lantikan + 4) => ($user->tahun_lantikan + 4),

                                ], $user->tahun_lantikan, ['class'=> 'form-select text-uppercase', 'id' => 'bulan_lantikan', 'disabled  ']);}}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="tamat_lantikan" class="col-md-4 col-form-label text-md-end">{{ __('Tarikh Tamat Lantikan') }}</label>
                            <div class="col-md-3">
                                {{Form::select('bulan_lantikan', [
                                    '01' => 'Januari',
                                    '02' => 'Februari',
                                    '03' => 'Mac',
                                    '04' => 'April',
                                    '05' => 'Mei',
                                    '06' => 'Jun',
                                    '07' => 'Julai',
                                    '08' => 'Ogos',
                                    '09' => 'September',
                                    '10' => 'October',
                                    '11' => 'November',
                                    '12' => 'Disember',
                                ], $user->bulan_lantikan, ['class'=> 'form-select text-uppercase', 'id' => 'bulan_lantikan', 'disabled']);}}
                            </div>
                            <div class="col-md-3">
                                <input id="tahun_tamat" type="text" class="form-select" name="tahun_tamat" value="2023" disabled >
                            </div>
                        </div>
                        @endif
                        <div class="row mb-3 ">
                            <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Jenis Akses') }}
                                <a href="#" class="text-warning" data-toggle="tooltip" title="Berhati-hati memberikan jenis akses kepada pengguna"><i class="fa-solid fa-triangle-exclamation"></i></a>
                            </label>
                            <div class="col-md-6">
                                {{Form::select('role', [
                                    '1' => 'Admin',
                                    '2' => 'PRIP',
                                    '4' => 'Calon PRIP',
                                    '3' => 'Pengguna',
                                ], $user->role, ['class'=> 'form-select', 'id' => 'inputGroupSelect01']);}}
                            </div>
                        </div>
                        {{Form::hidden('_method','PUT')}}
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary fw-bold">Kemaskini</button>
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
@endsection
