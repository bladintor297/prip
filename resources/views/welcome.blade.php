@extends('layouts.app')
@section('content')
    @guest
    <div class="container shadow-sm p-3 rounded  mt-5 bg-white" style="width: 80%">
        <div class="row h-100 align-items-center" style="margin-top: 40px; margin-bottom: 40px;">
            {{-- <div class="position-relative">
                <img class="position-absolute top-0 start-0" src=' {{asset('storage/images/zpeed-logo-white.png')}}'  width="150rem" />
            </div> --}}
            <div class="col-12 text-center">
                <p><img src="https://www.mohe.gov.my/images/new_logo_kpt_black.svg" alt=""></p>
                <p class="fw-bold text-dark text-uppercase mt-0" style="font-size: 1.5em;"> Jabatan Pendidikan Politeknik dan Kolej Komuniti </p>
                <hr class="border-3 border-top col-5 mx-auto border-dark">
                <p class="fw-bolder text-dark text-uppercase" style="font-size: 2.0em;"> Sistem Pensyarah Rujukan<br> Pembinaan Item Penilaian (PRIP)</p>
                <hr class="border-3 border-top col-5 mx-auto border-dark">

                <div class="d-flex justify-content-center gap-2">
                    <a href="{{ route('login') }}" class="btn btn-outline-warning fw-bold">Log Masuk</a>
                    <a href="{{ route('register') }}" class="btn btn-secondary fw-bold">Daftar</a>
                </div>
               
            </div>

            
        </div>
        {{--  --}}
    </div>
    <p class=" text-dark text-center text-uppercase mt-3" style="font-size: 0.7em;"> Bahagian Peperiksaan dan Penilaian</p>

    @else
        @include('home')
     @endguest

@endsection