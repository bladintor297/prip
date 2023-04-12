@extends('layouts.list')
@section('content')

<div class="container w-75">
    <ul class="nav nav-pills justify-content-center mt-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link fs-4 fw-bold rounded-pill" id="pills-one-tab" data-bs-toggle="pill" data-bs-target="#pills-one" type="button" role="tab" aria-controls="pills-one" aria-selected="true">Lulus ({{count($aktivitiL)}})</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link fs-4 fw-bold rounded-pill" id="pills-two-tab" data-bs-toggle="pill" data-bs-target="#pills-two" type="button" role="tab" aria-controls="pills-two" aria-selected="false">Belum Lulus ({{count($aktivitiB)}})</button>
        </li>
      </ul>
      <div class="tab-content" id="pills-tabContent">
        
        {{-- lulus List --}}
        <div class="tab-pane fade show active" id="pills-one" role="tabpanel" aria-labelledby="pills-one-tab" tabindex="0">
            <div class="sticky-lg-top pt-5 mb-2">
                <div class="card bg-white mt-3">
                    <p class="text-center fs-6 mt-2 fs-1 fw-bold ">Senarai Aktiviti<br></p>
                    <div class="input-group mb-3 ms-2">
                        <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Cari aktiviti...." aria-label="Cari PRIP...." aria-describedby="basic-addon2">
                        <div class="input-group-append ">
                            <span class="fw-bolder ms-1 me-3">
                                <button class="btn btn-secondary fw-bold" onclick="tapis()"><i class="fa-solid fa-filter"></i> Tapis</button>
                            </span>
                        </div>
                    </div>
            
            
                <form action="/filterAkt">
                    <div class="input-group mb-3 mx-2" id="filter" style="display: none;">
        
                        <select class="form-select me-1 text-uppercase" name="tahun" aria-label="Default select example">
                            <option value="0"selected>- Pilih Tahun -</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2022">2023</option>
                        </select>
                        <select class="form-select ms-1 text-uppercase" name="bulan" aria-label="Default select example">
                            <option value="0"selected>- Pilih Bulan -</option>
                            <option value="01"> Januari</option>
                            <option value="02"> Februari</option>
                            <option value="03"> Mac</option>
                            <option value="04"> April</option>
                            <option value="05"> Mei</option>
                            <option value="06"> Jun</option>
                            <option value="07"> July</option>
                            <option value="08"> Ogos</option>
                            <option value="09"> September</option>
                            <option value="10"> October</option>
                            <option value="11"> November</option>
                            <option value="12"> Disember</option>
                        </select>
                        <button type="submit" class="btn btn-primary ms-1 fw-bold me-3">Tapis  </button>
                    </div>
                </form>
                </div>
            </div>
            <div class="lulus-list">
                @if (count($aktivitiL)>0)
                <ul id="myUL" class="list-group mb-4">
                    @foreach ($aktivitiL as $aktiviti)
                    <li class="list-group-item">
                        <a href="#" style="display: none">{{{$aktiviti->nama}}} {{$aktiviti->tempat}} </a>
                        <div class="d-flex justify-content-between">
                            <div>


                                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteModal{{$aktiviti->id}}" class="btn btn-link fs-6 text-white px-2"><i class="fa-solid fa-trash-can text-danger"></i></button>
                                
                                {{-- Delete Modal --}}
                                <div class="modal fade" id="deleteModal{{$aktiviti->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Padam Rekod Aktiviti</h5>

                                            </div>

                                                <div class="modal-body">
                                            {!! Form::open(['class' => "row g-3", 'id' => 'delete-form', 'action' => ['\App\Http\Controllers\AktivitiController@destroy', $aktiviti->id], 'method'=>'DELETE','enctype' => 'multipart/form-data']) !!}

                                                    
                                                    <div class="col-md-12">
                                                        <label for="nama" class="form-label">Nama Aktiviti</label>
                                                        <input type="text" class="form-control" id="nama" name="nama" value="{{$aktiviti->nama}}" disabled>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="butiran" class="form-label">Butiran Aktiviti</label>
                                                        <textarea class="form-control" id="butiran" rows="3" name="butiran" disabled>{{$aktiviti->butiran}}</textarea>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="tarikh_mula" class="form-label">Tarikh Mula</label>
                                                        <input type="date" class="form-control" id="tarikh_mula" name="tarikh_mula" value="{{$aktiviti->tarikh_mula}}" disabled>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="tarikh_akhir" class="form-label">Tarikh Tamat</label>
                                                        <input type="date" class="form-control" id="tarikh_akhir" name="tarikh_akhir" value="{{$aktiviti->tarikh_akhir}}" disabled>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <label for="tempat" class="form-label">Tempat</label>
                                                        <input type="text" class="form-control" id="tempat" name="tempat" value="{{$aktiviti->tempat}}" disabled>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="bil_peserta" class="form-label">Bil Peserta </label>
                                                        <input type="number" class="form-control" id="bil_peserta" name="bil_peserta" value="{{$aktiviti->bil_peserta}}" disabled>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="institusi" class="form-label">Insitusi Terlibat</label>
                                                        <textarea class="form-control" id="institusi" rows="2" name="institusi" disabled>{{$aktiviti->institusi}}</textarea>
                                                    </div>
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-danger">Padam</button>
                                                </div>
                                            {!! Form::close() !!}


                                        </div>
                                    </div>
                                </div>
                                

                                <button type="button" data-bs-toggle="modal" data-bs-target="#editModal{{$aktiviti->id}}" class="btn btn-link fs-6 text-white px-2"><i class="fa-solid fa-pen-to-square text-primary"></i></button>
                                {{-- Edit Modal --}}
                                
                                <div class="modal fade" id="editModal{{$aktiviti->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Sunting Rekod Aktiviti</h5>

                                            </div>

                                                <div class="modal-body">
                                            {!! Form::open(['class' => "row g-3", 'action' => ['\App\Http\Controllers\AktivitiController@update', $aktiviti->id], 'method'=>'PUT','enctype' => 'multipart/form-data']) !!}

                                                    <div class="col-md-12">
                                                        <label for="nama" class="form-label">Nama Aktiviti</label>
                                                        <input type="text" class="form-control" id="nama" name="nama" value="{{$aktiviti->nama}}">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="butiran" class="form-label">Butiran Aktiviti</label>
                                                        <textarea class="form-control" id="butiran" rows="3" name="butiran">{{$aktiviti->butiran}}</textarea>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="tarikh_mula" class="form-label">Tarikh Mula</label>
                                                        <input type="date" class="form-control" id="tarikh_mula" name="tarikh_mula" value="{{$aktiviti->tarikh_mula}}">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="tarikh_akhir" class="form-label">Tarikh Tamat</label>
                                                        <input type="date" class="form-control" id="tarikh_akhir" name="tarikh_akhir" value="{{$aktiviti->tarikh_akhir}}">
                                                    </div>
                                                    <div class="col-md-9">
                                                        <label for="tempat" class="form-label">Tempat</label>
                                                        <input type="text" class="form-control" id="tempat" name="tempat" value="{{$aktiviti->tempat}}">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="bil_peserta" class="form-label">Bil Peserta </label>
                                                        <input type="number" class="form-control" id="bil_peserta" name="bil_peserta" value="{{$aktiviti->bil_peserta}}">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="institusi" class="form-label">Insitusi Terlibat</label>
                                                        <textarea class="form-control" id="institusi" rows="2" name="institusi">{{$aktiviti->institusi}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Simpan Rekod</button>
                                                </div>
                                            {!! Form::close() !!}


                                        </div>
                                    </div>
                                </div>
                                <span class="fs-6 fw-bolder text-uppercase">{{{$aktiviti->nama}}} 
                                    <span class="badge bg-warning text-dark">
                                        @foreach ($user as $usr)
                                            @if ($aktiviti->prip == $usr->id )
                                                {{$usr->name}}
                                            @else
                                                @continue
                                            @endif
                                        @endforeach
                                    </span>
                                </span>
                                <div class="d-flex justify-content-between">
                                    <div class="fs-6 text-muted d-flex justify-content-start">
                                        <span><i class="fa-solid fa-circle-info" style="margin-top: 0.3em"></i></span>
                                        <span class="ms-2">{{substr($aktiviti->butiran, null, 80);}}...</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="fs-6 d-flex justify-content-start">
                                        {{-- <i class="></i> --}}
                                        <span><i class="fa-solid fa-calendar-days" style="margin-top: 0.3em"></i></span>
                                        <span class="ms-2">
                                            <i>{{date("d-M-Y", strtotime($aktiviti->tarikh_mula));}}</i> &nbsp;hingga <i>{{date("d-M-Y", strtotime($aktiviti->tarikh_akhir));}}</i> | 
                                            <i class="fa-solid fa-location-dot mx-2"></i>{{$aktiviti->tempat}}
                                        </span>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            <div>
                                <button class="badge bg-primary rounded-pill fs-6 px-4"><a href="/aktiviti/{{$aktiviti->id}}" target="_blank" class="text-decoration-none text-white"><i class="fa-solid fa-file-pdf"></i> &nbsp;Laporan</a></button>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
                @else
                    <p>No prip available</p>
                @endif
            </div>
        </div>
    
        {{-- Aktiviti Belum Lulus List --}}
        <div class="tab-pane fade" id="pills-two" role="tabpanel" aria-labelledby="pills-two-tab">
            <div class="sticky-lg-top pt-5 mb-2">
                <div class="card bg-white mt-3">
                    <p class="text-center fs-6 mt-2 fs-1 fw-bold ">Aktiviti Belum Lulus<br></p>
                    <div class="input-group mb-3 ms-2 ">
                        <input type="text" class="form-control me-3" id="myInput2" onkeyup="myFunction2()" placeholder="Cari aktiviti...." aria-label="Cari PRIP...." aria-describedby="basic-addon2">
                    </div>
                </div>
            </div>
            <div class="belum">
                @if (count($aktivitiB)>0)
                <ul id="myUL" class="list-group mb-4">
                    @foreach ($aktivitiB as $aktiviti)
                    <li class="list-group-item">
                        <a href="#" style="display: none">{{{$aktiviti->nama}}} {{$aktiviti->tempat}} </a>
                        <div class="d-flex justify-content-between">
                            <div>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteModal1{{$aktiviti->id}}" class="btn btn-link fs-6 text-white px-2"><i class="fa-solid fa-trash-can text-danger"></i></button>
                                
                                {{-- Delete Modal --}}
                                <div class="modal fade" id="deleteModal1{{$aktiviti->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Padam Rekod Aktiviti</h5>

                                            </div>

                                                <div class="modal-body">
                                            {!! Form::open(['class' => "row g-3", 'id' => 'delete-form', 'action' => ['\App\Http\Controllers\AktivitiController@destroy', $aktiviti->id], 'method'=>'DELETE','enctype' => 'multipart/form-data']) !!}

                                                    
                                                    <div class="col-md-12">
                                                        <label for="nama" class="form-label">Nama Aktiviti</label>
                                                        <input type="text" class="form-control" id="nama" name="nama" value="{{$aktiviti->nama}}" disabled>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="butiran" class="form-label">Butiran Aktiviti</label>
                                                        <textarea class="form-control" id="butiran" rows="3" name="butiran" disabled>{{$aktiviti->butiran}}</textarea>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="tarikh_mula" class="form-label">Tarikh Mula</label>
                                                        <input type="date" class="form-control" id="tarikh_mula" name="tarikh_mula" value="{{$aktiviti->tarikh_mula}}" disabled>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="tarikh_akhir" class="form-label">Tarikh Tamat</label>
                                                        <input type="date" class="form-control" id="tarikh_akhir" name="tarikh_akhir" value="{{$aktiviti->tarikh_akhir}}" disabled>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <label for="tempat" class="form-label">Tempat</label>
                                                        <input type="text" class="form-control" id="tempat" name="tempat" value="{{$aktiviti->tempat}}" disabled>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="bil_peserta" class="form-label">Bil Peserta </label>
                                                        <input type="number" class="form-control" id="bil_peserta" name="bil_peserta" value="{{$aktiviti->bil_peserta}}" disabled>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="institusi" class="form-label">Insitusi Terlibat</label>
                                                        <textarea class="form-control" id="institusi" rows="2" name="institusi" disabled>{{$aktiviti->institusi}}</textarea>
                                                    </div>
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-danger">Padam</button>
                                                </div>
                                            {!! Form::close() !!}


                                        </div>
                                    </div>
                                </div>
                                

                                <button type="button" data-bs-toggle="modal" data-bs-target="#editModal1{{$aktiviti->id}}" class="btn btn-link fs-6 text-white px-2"><i class="fa-solid fa-pen-to-square text-primary"></i></button>
                                {{-- Edit Modal --}}
                                
                                <div class="modal fade" id="editModal1{{$aktiviti->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Sunting Rekod Aktiviti</h5>

                                            </div>

                                                <div class="modal-body">
                                            {!! Form::open(['class' => "row g-3", 'action' => ['\App\Http\Controllers\AktivitiController@update', $aktiviti->id], 'method'=>'PUT','enctype' => 'multipart/form-data']) !!}

                                                    <div class="col-md-12">
                                                        <label for="nama" class="form-label">Nama Aktiviti</label>
                                                        <input type="text" class="form-control" id="nama" name="nama" value="{{$aktiviti->nama}}">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="butiran" class="form-label">Butiran Aktiviti</label>
                                                        <textarea class="form-control" id="butiran" rows="3" name="butiran">{{$aktiviti->butiran}}</textarea>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="tarikh_mula" class="form-label">Tarikh Mula</label>
                                                        <input type="date" class="form-control" id="tarikh_mula" name="tarikh_mula" value="{{$aktiviti->tarikh_mula}}">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="tarikh_akhir" class="form-label">Tarikh Tamat</label>
                                                        <input type="date" class="form-control" id="tarikh_akhir" name="tarikh_akhir" value="{{$aktiviti->tarikh_akhir}}">
                                                    </div>
                                                    <div class="col-md-9">
                                                        <label for="tempat" class="form-label">Tempat</label>
                                                        <input type="text" class="form-control" id="tempat" name="tempat" value="{{$aktiviti->tempat}}">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="bil_peserta" class="form-label">Bil Peserta </label>
                                                        <input type="number" class="form-control" id="bil_peserta" name="bil_peserta" value="{{$aktiviti->bil_peserta}}">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="institusi" class="form-label">Insitusi Terlibat</label>
                                                        <textarea class="form-control" id="institusi" rows="2" name="institusi">{{$aktiviti->institusi}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Simpan Rekod</button>
                                                </div>
                                            {!! Form::close() !!}


                                        </div>
                                    </div>
                                </div>
                                <span class="fs-6 fw-bolder text-uppercase">{{{$aktiviti->nama}}} 
                                    <span class="badge bg-warning text-dark">
                                        @foreach ($user as $usr)
                                            @if ($aktiviti->prip == $usr->id )
                                                {{$usr->name}}
                                            @else
                                                @continue
                                            @endif
                                        @endforeach
                                    </span>
                                </span>
                                <div class="d-flex justify-content-between">
                                    <div class="fs-6 text-muted d-flex justify-content-start">
                                        <span><i class="fa-solid fa-circle-info" style="margin-top: 0.3em"></i></span>
                                        <span class="ms-2">{{substr($aktiviti->butiran, null, 80);}}...</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="fs-6 d-flex justify-content-start">
                                        {{-- <i class="></i> --}}
                                        <span><i class="fa-solid fa-calendar-days" style="margin-top: 0.3em"></i></span>
                                        <span class="ms-2">
                                            <i>{{date("d-M-Y", strtotime($aktiviti->tarikh_mula));}}</i> &nbsp;hingga <i>{{date("d-M-Y", strtotime($aktiviti->tarikh_akhir));}}</i> | 
                                            <i class="fa-solid fa-location-dot mx-2"></i>{{$aktiviti->tempat}}
                                        </span>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            <div>
                                <div class="d-flex gap-1 ps-2">
                                    <button class="badge bg-primary rounded-pill fs-6 px-4"><a href="/aktiviti/{{$aktiviti->id}}" target="_blank" class="text-decoration-none text-white"><i class="fa-solid fa-file-pdf"></i> &nbsp;Laporan</a></button>
                                    <div class="btn-group mx-auto gap-1"  role="group" aria-label="Basic outlined example">
                                        <a href="/aktiviti/{{$aktiviti->id}}/edit"class="badge bg-success rounded-pill fs-5 text-white px-2"><i class="fa-regular fa-circle-check fa-beat-fade"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
                @else
                    <p>No prip available</p>
                @endif
            </div>

        </div>
        <a class="btn btn-warning px-4 floating-btn rounded-pill " href ="/aktiviti/create">
            <i class="fa-brands fa-plus"></i>
            <span> Aktiviti Baru</span>
        </a>
    </div>
    
    <script>
        function tapis() {
            var x = document.getElementById("filter");
            if (x.style.display === "none") {
                x.style.display = "flex";
            } else {
                x.style.display = "none";
            }
        }
        const pillsTab = document.querySelector('#pills-tab');
        const pills = pillsTab.querySelectorAll('button[data-bs-toggle="pill"]');
    
        pills.forEach(pill => {
        pill.addEventListener('shown.bs.tab', (event) => {
            const { target } = event;
            const { id: targetId } = target;
            
            savePillId(targetId);
        });
        });
    
        const savePillId = (selector) => {
        localStorage.setItem('activePillId', selector);
        };
    
        const getPillId = () => {
        const activePillId = localStorage.getItem('activePillId');
        
        // if local storage item is null, show default tab
        if (!activePillId) return;
        
        // call 'show' function
        const someTabTriggerEl = document.querySelector(`#${activePillId}`)
        const tab = new bootstrap.Tab(someTabTriggerEl);
    
        tab.show();
        };
    
        // get pill id on load
        getPillId();
    </script>

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

    function myFunction2() {
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById("myInput2");
        filter = input.value.toUpperCase();
        ul = document.getElementById("myUL2");
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