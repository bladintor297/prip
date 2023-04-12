@extends('layouts.list')
@section('content')

<div class="container w-75">
    <div class="sticky-lg-top pt-5 mb-2">
        <div class="card bg-white mt-3">
            <p class="text-center fs-6 mt-2 fs-1 fw-bold ">Senarai PRIP<br></p>
            <div class="input-group mb-3 ms-2">
                <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Cari Pensyarah PRIP...." aria-label="Cari PRIP...." aria-describedby="basic-addon2">
                <div class="input-group-append ">
                    <span class="fw-bolder ms-1 me-3">
                        <button class="btn btn-secondary fw-bold" onclick="tapis()"><i class="fa-solid fa-filter"></i> Tapis</button>
                    </span>
                </div>
            </div>
    
    
            <form action="/filter">
                <div class="input-group mb-3 ms-2" id="filter" style="display: show;">
                    {{Form::select('negeri', [
                        '0' => 'SEMUA NEGERI',
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
                        ], $negeri, ['class'=> 'form-select text-uppercase', 'id' => 'inputGroupSelect01']);}}
        
                    {{Form::select('bidang', [
                        '0' => 'SEMUA BIDANG',
                        'KEJURUTERAAN MEKANIKAL' => 'KEJURUTERAAN MEKANIKAL',
                        'KEJURUTERAAN ELEKTRIK' => 'KEJURUTERAAN ELEKTRIK',
                        'KEJURUTERAAN AWAM & ALAM BINA' => 'KEJURUTERAAN AWAM & ALAM BINA',
                        'REKA BENTUK & KREATIF' => 'REKA BENTUK & KREATIF',
                        'HOSPITALITI & PELANCONGAN' => 'HOSPITALITI & PELANCONGAN',
                        'PENGURUSAN & PERDAGANGAN' => 'PENGURUSAN & PERDAGANGAN',
                        'TEKNOLOGI PERTANIAN' => 'TEKNOLOGI PERTANIAN',
                        'PERKOMPUTERAN' => 'PERKOMPUTERAN',
                        'PENGAJIAN PERKHIDMATAN' => 'PENGAJIAN PERKHIDMATAN',
                        'PENGAJIAN UMUM' => 'PENGAJIAN UMUM',
                        ], $bidang, ['class'=> 'form-select ms-1', 'id' => 'inputGroupSelect01']);}}
        
                    <button type="submit" class="btn btn-primary ms-1 fw-bold">Tapis  </button>
                    <a type="submit" href="/prip" class="btn btn-danger ms-1 fw-bold me-3">Kosongkan </a>
                </div>
            </form>
        </div>
    </div>

    

    <ul id="myUL" class="list-group mb-4">
        @if (count($prips)>0)
            @foreach ($prips as $prip)
            <li class="list-group-item">
                <a href="#" style="display: none">{{$prip->name}}</a>
                <div class="d-flex justify-content-between">
                    <div>
                        <span class="fs-5 fw-bolder text-uppercase">{{$prip->name}}</span>
                        <span class="badge bg-primary ms-2" style="font-size:0.8rem;">{{$prip->program}}</span>
                        <div class="fs-6 text-muted"><i class="fa-solid fa-location-dot me-2"></i> {{$prip->polikk}} | <i class="fa-solid fa-at ms-2"></i> {{$prip->email}}</div>
                    </div>
                    <div>
                        <button class="badge bg-success rounded-pill fs-6 px-4"><a href="/aktiviti/create/{{$prip->email}}" class="text-decoration-none text-white">Mohon</a></button>
                    </div>
                </div>
            </li>
            @endforeach
            
        @else
            <p>No prip available</p>
        @endif
    </ul>
    
    <script>
    function myFunction() {
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        ul = document.getElementById("myUL");
        li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }

    function tapis() {
        var x = document.getElementById("filter");
        if (x.style.display === "none") {
            x.style.display = "flex";
        } else {
            x.style.display = "none";
        }
    }
    </script>


@endsection