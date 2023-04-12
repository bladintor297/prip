@extends('layouts.list')
@section('content')

<div class="container w-75">
    <div class="sticky-lg-top pt-5 mb-2">
        <div class="card bg-white mt-3">
            <p class="text-center fs-6 mt-2 fs-1 fw-bold ">Senarai Modul<br></p>
            <div class="input-group mb-3 px-3">
                <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Cari Modul...." aria-label="Cari PRIP...." aria-describedby="basic-addon2">
            </div>
        </div>
    </div>

    <table class="table mt-3" id="myTable">
        <thead class="table-dark">
          <tr>
            <th scope="col" style="width: 1%">#</th>
            <th scope="col" style="width:10%">Modul</th>
            <th scope="col" style="width:15%">Tarikh Mula</th>
            <th scope="col" style="width:15%">Tarikh Tamat</th>
            <th scope="col" style="width:20%">Tempat</th>
            <th scope="col" >Butiran Modul</th>
            <th scope="col"  style="width:10%"></th>
          </tr>
        </thead>
            @php
                $i = 0;
            @endphp
            @foreach ($moduls as $modul)
            
                <tr>
                    <th scope="row">{{++$i}}</th>
                    <td >{{$modul->nama}}</td>
                    <td>{{(date('d-m-Y', strtotime($modul->tarikh_mula)))}}</td>
                    <td>{{(date('d-m-Y', strtotime($modul->tarikh_tamat)))}}</td>
                    <td>{{$modul->tempat}}</td>
                    <td>{{$modul->butiran_modul}}</td>

                    <td>
                        <a class="badge bg-primary" href="modul/{{$modul->id}}">
                            <i class="fa-solid fa-edit"></i>
                        </a>
                        <a type="button" class="badge bg-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{$modul->id}}" >
                            <i class="fa-solid fa-xmark"></i>
                        </a>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{$modul->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel"><b>Buang Rekod Modul?</b></h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Adakah anda mahu membuang rekod modul berikut? Tindakan ini adalah muktamad dan tidak boleh diulang semula. Rekod berikut akan dipadamkan dari <em>database.</em>
                                        <table class="table table-bordered mt-3">
                                            <tr>
                                                <th scope="col" style="width: 25%">Modul</th>
                                                <td>{{$modul->nama}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="col" style="width: 25%">Butiran</th>
                                                <td>{{$modul->butiran_modul}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="col" style="width: 20%">Tarikh Mula</th>
                                                <td>{{date('d/m/Y', strtotime($modul->tarikh_mula))}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="col" style="width: 20%">Tarikh Tamat</th>
                                                <td>{{date('d/m/Y', strtotime($modul->tarikh_tamat))}}</td>
                                            </tr>
                                        
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        {!! Form::open([ 'action' => ['\App\Http\Controllers\ModulController@destroy', $modul->id], 'method'=>'DELETE','enctype' => 'multipart/form-data']) !!}
                                            <button type="submit" class="btn btn-danger">Padam</button>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
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