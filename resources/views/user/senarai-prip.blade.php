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
            <div class="input-group mb-3 mx-2" id="filter" style="display: none;">

                <select class="form-select me-1 text-uppercase" name="negeri" aria-label="Default select example">
                    <option value="0"selected>- Pilih Negeri -</option>
                    <option value="Johor">Johor</option>
                    <option value="Kedah">Kedah</option>
                    <option value="Kelantan">Kelantan</option>
                    <option value="Melaka">Melaka</option>
                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                    <option value="Pahang">Three</option>
                    <option value="Perak Darul Ridzuan">Perak</option>
                    <option value="Perlis">Perlis</option>
                    <option value="Pulau Pinang">Pulau Pinang</option>
                    <option value="Sabah">Sabah</option>
                    <option value="Sarawak">Sarawak</option>
                    <option value="Selangor">Selangor</option>
                    <option value="Terengganu">Terengganu</option>
                    <option value="Wilayah Persekutuan Kuala Lumpur">Wilayah Persekutuan Kuala Lumpur</option>
                    <option value="Wilayah Persekutuan Labuan">Wilayah Persekutuan Labuan</option>
                    <option value="Wilayah Persekutuan Putrajaya">Wilayah Persekutuan Putrajaya</option>
                </select>
                <select class="form-select ms-1 text-uppercase" name="bidang" aria-label="Default select example">
                    <option value="0"selected>- Pilih bidang -</option>
                    <option value="KEJURUTERAAN MEKANIKAL"> KEJURUTERAAN MEKANIKAL </option>
                    <option value="KEJURUTERAAN ELEKTRIKAL"> KEJURUTERAAN ELEKTRIKAL </option>
                    <option value="KEJURUTERAAN AWAM & ALAM BINA"> KEJURUTERAAN AWAM & ALAM BINA </option>
                    <option value="REKA BENTUK & KREATIF"> REKA BENTUK & KREATIF </option>
                    <option value="HOSPITALITI & PELANCONGAN"> HOSPITALITI & PELANCONGAN </option>
                    <option value="PENGURUSAN & PERDAGANGAN"> PENGURUSAN & PERDAGANGAN </option>
                    <option value="TEKNOLOGI PERTANIAN"> TEKNOLOGI PERTANIAN </option>
                    <option value="PERKOMPUTERAN"> PERKOMPUTERAN </option>
                    <option value="PENGAJIAN PERKHIDMATAN"> PENGAJIAN PERKHIDMATAN </option>
                    <option value="PENGAJIAN UMUM"> PENGAJIAN UMUM </option>
                </select>
                <button type="submit" class="btn btn-primary ms-1 fw-bold me-3">Tapis  </button>
            </div>
        </form>
        </div>
    </div>

    <ul id="myUL" class="list-group mb-4">
        @if (count($prips)>0)
            @foreach ($prips as $prip)
            <li class="list-group-item">
                <a href="#" style="display: none">{{$prip->name}}</a>
                <a href="#" style="display: none">{{$prip->polikk}}</a>
                <div class="d-flex justify-content-between">
                    <div>
                        <span class="fs-5 fw-bolder text-uppercase">{{$prip->name}}</span>
                        <span class="badge bg-primary ms-2" style="font-size:0.8rem;">{{$prip->program}}</span>
                        <div class="fs-6 text-muted"><i class="fa-solid fa-location-dot me-2"></i> {{$prip->polikk}} | <i class="fa-solid fa-at ms-2"></i> {{$prip->email}}</div>
                    </div>
                    <div>
                        @if ($prip->status == 2)
                        <button class="badge bg-danger rounded-pill fs-6 px-3" disabled ><a href="#" class="text-decoration-none text-white opacity-75" style="cursor:not-allowed">Tamat Lantikan</a></button>
                            
                        @else
                        <button class="badge bg-success rounded-pill fs-6 px-5"><a href="/aktiviti/create/{{$prip->email}}" class="text-decoration-none text-white">Mohon</a></button>
                        @endif
                    </div>
                </div>
            </li>
            @endforeach
            
        @else
            <ul class="list-group">
                <li class="list-group-item text-center mt-2">Tiada rekod prip</li>
            </ul>
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