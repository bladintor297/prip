@extends('layouts.app')

@section('content')
<p class="text-center fs-6 mt-2 fs-1 fw-bold">Profil Saya<br></p>
<div class="container overflow-auto">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (Session::get('role')==='1' || Session::get('role')==='2')
                <div class="card">
                    <div class="card-body scroll">
                            <div class ="text-center mb-5">
                                <strong>Lengkapkan semua butiran di bawah. </strong>
                            </div>
                            {!! Form::open(['class' => "row g-3", 'action' => ['\App\Http\Controllers\UserController@update', $user->id], 'method'=>'POST','enctype' => 'multipart/form-data']) !!}
                            @csrf

                            <div class="row input-group mb-2">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Emel PRIP') }}</label>
                                <div class="col-md-6 d-flex">
                                    <input  id="pensyarah" type="email" class="form-control" name="pensyarah" value="{{$user->email}}" disabled="disabled">
                                    <button class="btn btn-outline-primary" type="button" id="btn-email"><i class="fas fa-edit"></i></button>
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
                                    ], $user->bidang, ['class'=> 'form-select', 'id' => 'inputGroupSelect01']);}}
                                </div>
                            </div>
                            <div class="row mb-2 ">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Program Pengajian') }}</label>
                                <div class="col-md-6">
                                    <input id="program" type="text" class="form-control" name="program" value="{{$user->program}}" placeholder="Program pengajian..." required>
                                </div>
                            </div>
                            <div class="row mb-2 ">
                                <label for="institusi" class="col-md-4 col-form-label text-md-end">{{ __('Institusi Pengajian') }}</label>
                                <div class="col-md-6">
                                    <input id="institusi" type="text" class="form-control" name="institusi" value="{{$user->polikk}}" placeholder="Program pengajian..." required>
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
                                    ], $user->negeri, ['class'=> 'form-select text-uppercase', 'id' => 'inputGroupSelect01']);}}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="emel_google" class="col-md-4 col-form-label text-md-end">{{ __('Emel google') }}</label>
                                <div class="col-md-6">
                                    <input id="emel_google" type="email" class="form-control" name="emel_google" placeholder="Emel alternatif @google.com" value="{{$user->emel_google}}" >
                                </div>
                            </div>
                            @if (Session::get('role')==='2')
                            <div class="row mb-2 ">
                                <label for="sesi_lantikan" class="col-md-4 col-form-label text-md-end">{{ __('Sesi Lantikan PRIP') }}</label>
                                <div class="col-md-2">
                                    <input id="bulan_lantikan" type="text" class="form-select" name="bulan_lantikan" value="{{$user->bulan_lantikan}}" disabled>
                                </div>
                                <div class="col-md-4">
                                    <input id="tahun_lantikan" type="text" class="form-select" name="tahun_lantikan" value="{{$user->tahun_lantikan}}" placeholder="Tahun lantikan PRIP..." disabled>
                                </div>
                            </div>
                            <div class="row mb-3 ">
                                <label for="tamat_lantikan" class="col-md-4 col-form-label text-md-end">{{ __('Tarikh Tamat Lantikan') }}</label>
                                <div class="col-md-2">
                                    <input id="bulan_lantikan" type="text" class="form-select" name="bulan_lantikan" value="{{$user->bulan_lantikan}}" placeholder="Tahun lantikan PRIP..." disabled>
                                </div>
                                <div class="col-md-4">
                                    <input id="tahun_lantikan" type="text" class="form-select" name="tahun_tamat" value="{{$tamat_lantikan}}"  disabled>
                                </div>
                            </div>
                            @endif

                            {{Form::hidden('_method','PUT')}}
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary fw-bold">Kemaskini</button>
                                </div>
                            </div>
                            {!! Form::close() !!} 
                    </div>
                </div>
            @else
                <div class="card">
                    <div class="card-body scroll">
                            <div class ="text-center mb-5">
                                <strong>Lengkapkan semua butiran di bawah. </strong>
                            </div>
                            {!! Form::open(['class' => "row g-3", 'action' => ['\App\Http\Controllers\UserController@update', $user->id], 'method'=>'POST','enctype' => 'multipart/form-data']) !!}
                            @csrf
                            <div class="row input-group mb-2">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Emel PRIP') }}</label>
                                <div class="col-md-6 d-flex">
                                    <input  id="pensyarah" type="email" class="form-control" name="pensyarah" value="{{$user->email}}" disabled="disabled">
                                    <button class="btn btn-outline-primary" type="button" id="btn-email"><i class="fas fa-edit"></i></button>
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
                                    ], $user->bidang, ['class'=> 'form-select', 'id' => 'inputGroupSelect01']);}}
                                </div>
                            </div>
                            <div class="row mb-2 ">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Program Pengajian') }}</label>
                                <div class="col-md-6">
                                    <input id="program" type="text" class="form-control" name="program" value="{{$user->program}}" placeholder="Program pengajian..." required>
                                </div>
                            </div>
                            <div class="row mb-2 ">
                                <label for="institusi" class="col-md-4 col-form-label text-md-end">{{ __('Institusi Pengajian') }}</label>
                                <div class="col-md-6">
                                    <input id="institusi" type="text" class="form-control" name="institusi" value="{{$user->polikk}}" placeholder="Program pengajian..." required>
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
                                    ], $user->negeri, ['class'=> 'form-select text-uppercase', 'id' => 'inputGroupSelect01']);}}
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
                
            @endif
        </div>
    </div>
    <a class="btn btn-warning px-4 floating-btn rounded-pill " href ="/change-password">
        <i class="fa-solid fa-lock"></i>
        <span> Tukar Kata Laluan</span>
    </a>
</div>

<script>

$("#btn-email").click(function() {
  $("#pensyarah").attr('disabled', !$("#pensyarah").attr('disabled'));
});

function check(that) {

    document.getElementById("tahun_tamat").value = that.value;

    }
</script>

@endsection
