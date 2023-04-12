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
                    <p class="text-center fs-6 mt-2 fs-1 fw-bold ">Senarai PRIP<br></p>
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

                        {{Form::select('tahun', [
                            '0' => 'SEMUA TAHUN',
                            '2020' => '2020',
                            '2021' => '2021',
                            '2022' => '2022',
                            '2023' => '2023',
                        ], $tahun, ['class'=> 'form-select ms-1', 'id' => 'inputGroupSelect01']);}}
                        {{Form::select('bulan', [
                            '0' => 'SEMUA BULAN',
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
                        ], $bulan, ['class'=> 'form-select ms-1', 'id' => 'inputGroupSelect01']);}}

                        <button type="submit" class="btn btn-primary ms-1 fw-bold me-1">Tapis  </button>
                        <a href="/aktiviti" class="btn btn-danger ms-1 fw-bold me-3">Kosongkan </a>
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
                                <span class="fs-5 fw-bolder text-uppercase">{{{$aktiviti->nama}}} 
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
                    <p>Tiada rekod aktiviti</p>
                @endif
            </div>
        </div>
    
        {{-- Aktiviti Belum Lulus List --}}
        <div class="tab-pane fade" id="pills-two" role="tabpanel" aria-labelledby="pills-two-tab">
            <div class="sticky-lg-top pt-5 mb-2">
                <div class="card bg-white mt-3">
                    <p class="text-center fs-6 mt-2 fs-1 fw-bold ">Aktiviti Belum Lulus<br></p>
                    <div class="input-group mb-3 ms-2 ">
                        <input type="text" class="form-control me-3" id="myInput2" onkeyup="myFunction2()" placeholder="Carian PRIP...." aria-label="Cari PRIP...." aria-describedby="basic-addon2">
                    </div>
                </div>
            </div>
            <div class="belum">
                
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