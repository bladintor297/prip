@extends('layouts.list')
@section('content')

<div class="container w-75">
    <div class="sticky-lg-top pt-5 mb-2">
        <div class="card bg-white mt-3">
            <p class="text-center mt-2 fs-1 fw-bold mb-0 ">Senarai Kehadiran<br></p>
            <div class=" text-center mb-2">
                <div class="fs-5 fw-bold"><span class="fst-italic">Modul {{substr($modul->kod_modul, -1); }}</span> ({{date('d/m/y', strtotime($modul->tarikh_mula))}} - {{date('d/m/y', strtotime($modul->tarikh_tamat))}})</div>
                <div><span class="fs-6 fst-italic">{{$modul->butiran_modul}}</span></div>
            </div>
            <div class="input-group mb-3 px-3 justify-content-end">
                {!! Form::open(['class' => "d-flex justify-content-between col-5", 'action' => ['\App\Http\Controllers\ModulController@update', $id], 'method'=>'PUT','enctype' => 'multipart/form-data']) !!}
                @csrf    
                    <div class="input-group">
                        <input type="text" class="form-control" name="no_kp" placeholder="No K/P Peserta" aria-label="Cari PRIP...." aria-describedby="basic-addon2">
                        <input type="hidden" name="kod" value="{{$modul->kod_modul}}">
                        <button type="submit" class="btn btn-primary fw-bolder">+</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <table class="table mt-3" id="myTable">
        <thead class="table-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col" style="width:70%">Nama</th>
            <th scope="col" style="width:20%">No K/P</th>
          </tr>
        </thead>
            @php
                $i = 0;
            @endphp
            @if (count($peserta)>0)
                @foreach ($peserta as $ps)
                    <tr>
                        <th scope="row">{{++$i}}</th>
                        <td >{{$ps->nama}}</td>
                        <td >{{$ps->no_kp}}</td>
                    </tr>
                @endforeach

            @else
            <tr>
                <td></td>
                <td>
                Tiada rekod peserta
                </td>
                <td></td>
            </tr>
            @endif
                
      </table>

      <a class="btn btn-warning px-4 floating-btn rounded-pill " href ="/modul/create">
        <i class="fa-brands fa-plus"></i>
        <span> Modul Baru</span>
    </a>
</div>
    
    <script>
    function myFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
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