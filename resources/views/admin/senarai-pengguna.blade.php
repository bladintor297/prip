@extends('layouts.list')
@section('content')
<?php 
use App\Http\Controllers\PRIPController; 
$array = array(1, 2, 3, 4, 5); 
$arrayList[] = array();
?>

<div class="container w-75">
    
    <ul class="nav nav-pills justify-content-center mt-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link fs-4 fw-bold rounded-pill" id="pills-one-tab" data-bs-toggle="pill" data-bs-target="#pills-one" type="button" role="tab" aria-controls="pills-one" aria-selected="true">Pengguna ({{count($penggunas)}})</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link fs-4 fw-bold rounded-pill" id="pills-two-tab" data-bs-toggle="pill" data-bs-target="#pills-two" type="button" role="tab" aria-controls="pills-two" aria-selected="false">PRIP ({{count($prips)}})</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fs-4 fw-bold rounded-pill" id="pills-four-tab" data-bs-toggle="pill" data-bs-target="#pills-four" type="button" role="tab" aria-controls="pills-four" aria-selected="false">Calon PRIP ({{count($cprips)}})</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link fs-4 fw-bold rounded-pill" id="pills-three-tab" data-bs-toggle="pill" data-bs-target="#pills-three" type="button" role="tab" aria-controls="pills-three" aria-selected="false">Admin ({{count($admins)}})</button>
        </li>
      </ul>
      <div class="tab-content" id="pills-tabContent">
        
        {{-- Active List --}}
        <div class="tab-pane fade " id="pills-one" role="tabpanel" aria-labelledby="pills-one-tab" tabindex="0">
            <div class="sticky-lg-top pt-5 mb-2">
                <div class="card bg-white mt-3">
                    <p class="text-center fs-6 mt-2 fs-1 fw-bold ">Semua Pengguna<br></p>
                    <div class="input-group mb-3 ms-2 ">
                        <input type="text" class="form-control me-3" id="myInput" onkeyup="myFunction()" placeholder="Carian pengguna...." aria-label="Cari PRIP...." aria-describedby="basic-addon2">
                    </div>
                </div>
            </div>
            <div class="pengguna-list">
                @if (count($penggunas)>0)
                <ul id="myUL" class="list-group mb-4">
                    @foreach ($penggunas as $prip)
                    <li class="list-group-item">
                        <a href="#" style="display: none">{{$prip->name}}</a>
                        <a href="#" style="display: none">{{$prip->polikk}}</a>
                        <div class="d-flex justify-content-between">
                            <div>
                                <span class="fs-5 fw-bolder text-uppercase">{{$prip->name}}</span>
                                <span class="badge bg-primary ms-2" style="font-size:0.8rem;">{{$prip->program}}</span>
                                <div class="fs-6 text-muted"><i class="fa-solid fa-location-dot me-2"></i> {{$prip->polikk}}</div>
                                <div class="fs-6 text-muted"><i class="fa-solid fa-at me-2"></i> {{$prip->email}}</div>
                            </div>
                            <div>
                                <button class="badge bg-primary rounded-pill fs-6 px-3"><a href="/mohon-aktiviti/{{$prip->id}}" class="text-decoration-none text-white ">Permohonan</a></button>
                                <button class="badge bg-warning rounded-pill fs-6 px-2"><a href="/prip/{{$prip->id}}/edit" class="text-decoration-none text-dark ">Sunting</a></button>
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
    
        {{-- Prip List --}}
        <div class="tab-pane fade  show active" id="pills-two" role="tabpanel" aria-labelledby="pills-two-tab">
            <div class="sticky-lg-top pt-5 mb-2">
                <div class="card bg-white mt-3">
                    <p class="text-center fs-6 mt-2 fs-1 fw-bold ">Semua PRIP<br></p>
                    <div class="input-group mb-3 ms-2 ">
                        <input type="text" class="form-control me-1" id="myInput2" onkeyup="myFunction2()" placeholder="Carian PRIP...." aria-label="Cari PRIP...." aria-describedby="basic-addon2">
                        <a class="btn btn-primary fw-bold me-3" type="button" id="btn" href="/sort/{{$sort}}"><i class="fa-solid fa-arrow-up-wide-short"></i> {{$sort}}</a>
                    </div>
                </div>
            </div>
            <div class="prip-list">
                @if (count($prips)>0)
                <ul id="myUL2" class="list-group mb-4">
                    @foreach ($prips as $prip)

                    @if ($prip->status === 2)
                        <li class="list-group-item bg-danger">
                    @else
                        <li class="list-group-item">
                    @endif

                        <a href="#" style="display: none">{{$prip->name}}</a>
                        <a href="#" style="display: none">{{$prip->polikk}}</a>
                        <div class="d-flex justify-content-between">
                            <div>
                                {{-- App\Http\Controllers\PaymentController --}}
                                <span class="fs-5 fw-bolder text-uppercase">{{$prip->name}}</span>
                                <span class=" badge bg-primary ms-2" style="font-size:0.8rem;">{{$prip->program}}</span>
                                <div class="fs-6 "><i class="fa-solid fa-location-dot me-2"></i> {{$prip->polikk}} | <i class="fa-solid fa-at ms-2"></i> {{$prip->email}}</div>
                                <div class="fs-6 ">
                                    <i class="fa-solid fa-users-between-lines me-2"></i> {{App\Http\Controllers\AktivitiController::kiraPeserta($prip->id)}} orang peserta | 
                                    <i class="fa-solid fa-list-ul mx-2"></i> {{$prip->bil_aktiviti}} aktiviti | 
                                    <i class="fa-solid fa-calendar-day mx-2"></i> {{App\Http\Controllers\AktivitiController::kiraHari($prip->id)}} hari</div>
                            </div>
                            <div>
                                <button class="badge bg-primary rounded-pill fs-6 px-3"><a href="/aktiviti-prip/{{$prip->id}}" class="text-decoration-none text-white ">Aktiviti</a></button>
                                <button class="badge bg-warning rounded-pill fs-6 px-2"><a href="/prip/{{$prip->id}}/edit" class="text-decoration-none text-dark ">Sunting</a></button>
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

        {{--Calon PRIP  --}}
        <div class="tab-pane fade" id="pills-four" role="tabpanel" aria-labelledby="pills-four-tab">
            <div class="sticky-lg-top pt-5 mb-2">
                <div class="card bg-white mt-3">
                    <p class="text-center fs-6 mt-2 fs-1 fw-bold ">Semua Calon PRIP<br></p>
                    <div class="input-group mb-3 ms-2 ">
                        <input type="text" class="form-control me-1" id="myInput4" onkeyup="myFunction4()" placeholder="Carian Calon PRIP...." aria-label="Cari PRIP...." aria-describedby="basic-addon2">
                    </div>
                </div>
            </div>
            <div class="prip-list">
                @if (count($cprips)>0)
                <ul id="myUL4" class="list-group mb-4">
                    @foreach ($cprips as $prip)

                    <li class="list-group-item">
                        <a href="#" style="display: none">{{$prip->name}}</a>
                        <a href="#" style="display: none">{{$prip->polikk}}</a>
                        <div class="d-flex justify-content-between">
                            <div>
                                {{-- App\Http\Controllers\PaymentController --}}
                                <span class="fs-5 fw-bolder text-uppercase">{{$prip->name}}</span>
                                <div>
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if(PRIPController::status($i, $prip->id))
                                            <span class="badge bg-success text-uppercase">M{{$i}}</span>
                                        @else
                                            <span class="badge bg-danger text-uppercase">M{{$i}}</span>
                                        @endif
                                        
                                    @endfor
                                </div>
                                <div class="fs-6 "><i class="fa-solid fa-location-dot me-2"></i> {{$prip->polikk}} | <i class="fa-solid fa-at ms-2"></i> {{$prip->email}}</div>
                            </div>
                            <div>
                                <button class="badge bg-primary rounded-pill fs-6 px-3"><a href="/prip/{{$prip->id}}" class="text-decoration-none text-white ">Modul</a></button>
                                <button class="badge bg-warning rounded-pill fs-6 px-2"><a href="/prip/{{$prip->id}}/edit" class="text-decoration-none text-dark ">Sunting</a></button>
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
    
        {{-- Admin List --}}
        <div class="tab-pane fade" id="pills-three" role="tabpanel" aria-labelledby="pills-three-tab">
            <div class="sticky-lg-top pt-5 mb-2">
                <div class="card bg-white mt-3">
                    <p class="text-center fs-6 mt-2 fs-1 fw-bold ">Semua Admin<br></p>
                    <div class="input-group mb-3 ms-2 ">
                        <input type="text" class="form-control me-3" id="myInput3" onkeyup="myFunction3()" placeholder="Carian admin...." aria-label="Cari PRIP...." aria-describedby="basic-addon2">
                    </div>
                </div>
            </div>
            <div class="admin-list">
                @if (count($admins)>0)
                <ul id="myUL2" class="list-group mb-4">
                    @foreach ($admins as $prip)
                    <li class="list-group-item">
                        <a href="#" style="display: none">{{$prip->name}}</a>
                        <a href="#" style="display: none">{{$prip->polikk}}</a>
                        <div class="d-flex justify-content-between">
                            <div>
                                {{-- App\Http\Controllers\PaymentController --}}
                                <span class="fs-5 fw-bolder text-uppercase">{{$prip->name}}</span>
                                <div class="fs-6 "><i class="fa-solid fa-phone me-2"></i> +6{{$prip->telefon}} | <i class="fa-solid fa-at ms-2"></i> {{$prip->email}}</div>
                    
                            </div>
                            <div>
                                <button class="badge bg-warning rounded-pill fs-6 px-2"><a href="/prip/{{$prip->id}}/edit" class="text-decoration-none text-dark ">Sunting</a></button>
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
    
        <a class="btn btn-warning px-4 floating-btn rounded-pill" href ="/admin">
            <i class="fa-brands fa-plus"></i>
            Pengguna Baru

            @if (count($pendings)>0)
            <span class="position-absolute top-0 end-0 translate-middle p-2 bg-danger border border-light rounded-circle">
                <span class="visually-hidden">New alerts</span>
            </span>    
            @endif
            
        </a>
    </div>
    <script>
 
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

    function myFunction3() {
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById("myInput3");
        filter = input.value.toUpperCase();
        ul = document.getElementById("myUL3");
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

    function myFunction4() {
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById("myInput4");
        filter = input.value.toUpperCase();
        ul = document.getElementById("myUL4");
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