@extends('layouts.app')
@section('content')
<?php use App\Http\Controllers\ModulController;
    $array = array(1, 2, 3, 4, 5); 
    // $modul = ModulController::check($name);
?>

<p class="text-center fs-6 mt-2 fs-1 fw-bold">Senarai Modul<br></p>

    
    <div class="row mt-1 d-flex justify-content-center">
        <div class="col-xl-8 mb-1">
            <span class="badge bg-warning text-dark px-3">Selesai</span>
        </div>
    </div>

    @for ($i = 0; $i < count($modul); $i++)
        <div class="row mt-1 d-flex justify-content-center">
            <div class="col-xl-8 mb-1">
                <div class="card">
                    <div class="card-body">
                    <div class="d-flex justify-content-between px-md-1">
                        <div class="d-grid col-11">
                            <h3 class="text-success fw-bolder"> MODUL {{substr($modul[$i]->kod_modul, -1)}}</h3>
                            <p align="justify" class="mb-2 fs-5 text-muted me-4">{{$modul[$i]->butiran_modul}}.</p>
                            <p class="mb-0 text-end">Tarikh Tamat Kursus: {{date('d-m-Y', strtotime($modul[$i]->tarikh_tamat))}}</p>
                        </div>
                        <div class="d-grid col-1 align-self-center justify-content-end">
                            <i class="fa-solid fa-check-circle text-success fa-3x"></i>
                        </div>
                        
                    </div>
                    </div>
                </div>
            </div>
        </div> 
        
        @php
            $array = array_diff($array, array(substr($modul[$i]->kod_modul, -1)));
        @endphp
    @endfor

    @php
        $array = array_values($array);
    @endphp

    <div class="row mt-5 d-flex justify-content-center">
        <div class="col-xl-8 mb-1">
            <span class="badge bg-warning text-dark px-3">Belum Selesai</span>
        </div>
    </div>

    @for ($i = 0; $i < 5 - count($modul); ++$i)
        <div class="row mt-1 d-flex justify-content-center">
            <div class="col-xl-8 mb-1">
                <div class="card">
                    <div class="card-body">
                    <div class="d-flex justify-content-between px-md-1">
                        <div class="d-grid col-11">
                            <h3 class="text-danger fw-bolder"> MODUL {{$array[$i]}}</h3>
                            <p align="justify" class="mb-2 fs-5 text-muted me-4">Belum dikemaskini.</p>
                        </div>
                        <div class="d-grid col-1 align-self-center justify-content-end">
                            <i class="fa-solid fa-xmark-circle text-danger fa-3x"></i>
                        </div>
                        
                    </div>
                    </div>
                </div>
            </div>
        </div> 
    @endfor

@endsection
