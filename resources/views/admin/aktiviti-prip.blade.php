@extends('layouts.list')

@section('content')

<p class="text-center fs-6 mt-2 fs-1 fw-bold">Aktiviti PRIP<br></p>
<p class="text-center fs-6 mt-2 fw-bold">{{$user->name}}<br></p>
<div class="container w-75">
    <ul class="nav nav-pills mb-3 justify-content-center mt-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
        <button class="nav-link fs-4 fw-bold rounded-pill" id="pills-one-tab" data-bs-toggle="pill" data-bs-target="#pills-one" type="button" role="tab" aria-controls="pills-one" aria-selected="true">Aktiviti PRIP</button>
        </li>
        <li class="nav-item" role="presentation">
        <button class="nav-link fs-4 fw-bold rounded-pill" id="pills-two-tab" data-bs-toggle="pill" data-bs-target="#pills-two" type="button" role="tab" aria-controls="pills-two" aria-selected="false">Permohonan Aktiviti</button>
        </li>
        {{-- <li class="nav-item" role="presentation">
        <button class="nav-link fs-4 fw-bold rounded-pill" id="pills-three-tab" data-bs-toggle="pill" data-bs-target="#pills-three" type="button" role="tab" aria-controls="pills-three" aria-selected="false">Admin</button>
        </li> --}}
    </ul>
    <div class="tab-content" id="pills-tabContent">

        {{-- Aktiviti PRIP List --}}
        <div class="tab-pane fade show active" id="pills-one" role="tabpanel" aria-labelledby="pills-one-tab" tabindex="0">
            <div class="aktiviti-list">
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Cari aktiviti..." aria-label="Cari aktiviti" aria-describedby="basic-addon2">
            </div>
        
            @if (count($aktivitii)>0)
            <ul id="myUL" class="list-group" >
        
                @if (count($aktivitiL)>0)
                    <span class="fs-6 fw-bolder text-dark mb-2 text-start">Lulus ({{count($aktivitiL)}})</span>
                @endif
                        @foreach ($aktivitii as $aktiviti)
                            @if ($aktiviti->status === 1)
                            
                                <li class="list-group-item">
                                    <a href="#" style="display: none">{{{$aktiviti->nama}}}</a>
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <span class="fs-5 fw-bolder text-uppercase">{{{$aktiviti->nama}}}</span>
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
                                                    <span class="ms-2"><i>{{date("d-M-Y", strtotime($aktiviti->tarikh_mula));}}</i> &nbsp;hingga <i>{{date("d-M-Y", strtotime($aktiviti->tarikh_akhir));}}</i></span>
                                                </div>
                                                
                                            </div>
                                            <span><i class="fa-solid fa-location-dot me-2"></i>{{$aktiviti->tempat}}</span>
                                            
                                        </div>
                                        <div>
                                            <button class="badge bg-primary rounded-pill fs-6 px-4"><a href="/aktiviti/{{$aktiviti->id}}" target="_blank" class="text-decoration-none text-white"><i class="fa-solid fa-file-pdf"></i> &nbsp;Laporan</a></button>
                                            
                                        </div>
                                    </div>
                                </li>
                            @else
                                @continue
                            @endif
                        @endforeach
                
                @if (count($aktivitiB)>0)
                    <span class="fs-6 fw-bolder text-dark mb-2 text-start mt-3">Belum Lulus ({{count($aktivitiB)}})</span>
                @endif
                        @foreach ($aktivitii as $aktiviti)
                            @if ($aktiviti->status === 0)
                                <li class="list-group-item">
                                    <a href="#" style="display: none">{{{$aktiviti->daripada}}}</a>
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <span class="fs-5 fw-bolder text-uppercase">{{{$aktiviti->nama}}}</span>
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
                                                    <span class="ms-2"><i>{{date("d-M-Y", strtotime($aktiviti->tarikh_mula));}}</i> &nbsp;hingga <i>{{date("d-M-Y", strtotime($aktiviti->tarikh_akhir));}}</i></span>
                                                </div>
                                                
                                            </div>
                                            <span><i class="fa-solid fa-location-dot me-2"></i>{{$aktiviti->tempat}}</span>
                                            
                                        </div>
                                        <div>
                                            <button class="badge bg-primary rounded-pill fs-6 px-4"><a href="/aktiviti/{{$aktiviti->id}}" target="_blank" class="text-decoration-none text-white"><i class="fa-solid fa-file-pdf"></i> &nbsp;Laporan</a></button>
                                            <button data-bs-target="#approve{{$aktiviti->id}}" data-bs-toggle="modal"class="badge bg-success rounded-pill fs-6 px-2"><i class="fa-solid fa-check fw-bolder"></i></button>
        
                                            <div class="modal fade" id="approve{{$aktiviti->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-center" id="exampleModalLabel">Luluskan <b>{{$aktiviti->nama}} </b>?</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Bersetuju untuk meluluskan aktiviti {{$aktiviti->id}}?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a type="button" class="btn btn-success" href="/aktiviti/{{$aktiviti->id}}/edit"><b>Luluskan</b></a>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><b>Tutup</b></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @else
                                @continue
                            @endif
                        @endforeach
            </ul>
            @else
                <p>Tiada rekod aktiviti</p>
                        
            @endif
        
            </div>
        </div>

        {{-- Permohonan Luar List --}}
        <div class="tab-pane fade" id="pills-two" role="tabpanel" aria-labelledby="pills-two-tab">
            <div class="permohonan-list">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="myInput2" onkeyup="myFunction2()" placeholder="Cari aktiviti..." aria-label="Cari aktiviti" aria-describedby="basic-addon2">
                </div>
            
                @if (count($mohon)>0)
                <ul id="myUL2" class="list-group" >
            
                    @if (count($mohonL)>0)
                        <span class="fs-6 fw-bolder text-dark mb-2 text-start mt-3"><span class=" badge bg-success">Diterima</span></span>
                    @endif
                            @foreach ($mohon as $aktiviti)
                                @if ($aktiviti->status === 1)
                                    <li class="list-group-item">
                                        <a href="#" style="display: none">{{{$aktiviti->nama}}}</a>
                                        <div class="d-flex justify-content-between">
                                            <div >
                                                <div class="d-flex justify-content-between">
                                                    <span class="fs-5 fw-bolder text-uppercase">{{{$aktiviti->nama}}}</span>
                                                    <span class="text-muted">
                                                        <em>
                                                            <span>(Dihantar kepada: </span>
                                                            <span><i class="fa-solid fa-at "></i></span>
                                                            <span> {{$aktiviti->kepada}})</span>
                                                        </em>
                                                    </span>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <div class="fs-6 d-flex justify-content-start">
                                                        <span><i class="fa-solid fa-circle-info" style="margin-top: 0.3em"></i></span>
                                                        <span class="ms-2">{{$aktiviti->cadangan_aktiviti}}</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end mt-2">
                                                    <div class="fs-6 d-flex justify-content-start gap-1">
                                                        <span class="badge bg-primary rounded-pill">{{$user->polikk}}</span>
                                                        <span class="badge bg-warning rounded-pill text-dark">{{$user->negeri}}</span>
                                                    </div>
                                                    
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </li>
                                @else
                                    @continue
                                @endif
                            @endforeach
                    
                    @if (count($mohonB)>0)
                        <span class="fs-6 fw-bolder text-dark mb-2 text-start mt-3"><span class=" badge bg-warning">Belum Diterima</span></span>
                    @endif
                            @foreach ($mohon as $aktiviti)
                                @if ($aktiviti->status === 0)
                                    <li class="list-group-item">
                                        <a href="#" style="display: none">{{{$aktiviti->nama}}}</a>
                                        <div class="d-flex justify-content-between">
                                            <div >
                                                <div class="d-flex justify-content-between">
                                                    <span class="fs-5 fw-bolder text-uppercase">{{{$aktiviti->nama}}}</span>
                                                    <span class="text-muted">
                                                        <em>
                                                            <span>(Dihantar kepada: </span>
                                                            <span><i class="fa-solid fa-at "></i></span>
                                                            <span> {{$aktiviti->kepada}})</span>
                                                        </em>
                                                    </span>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <div class="fs-6 d-flex justify-content-start">
                                                        <span><i class="fa-solid fa-circle-info" style="margin-top: 0.3em"></i></span>
                                                        <span class="ms-2">{{$aktiviti->cadangan_aktiviti}}</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end mt-2">
                                                    <div class="fs-6 d-flex justify-content-start gap-1">
                                                        <span class="badge bg-primary rounded-pill">{{$user->polikk}}</span>
                                                        <span class="badge bg-warning rounded-pill text-dark">{{$user->negeri}}</span>
                                                    </div>
                                                    
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </li>
                                @else
                                    @continue
                                @endif
                            @endforeach

                    @if (count($mohonT)>0)
                        <span class="fs-6 fw-bolder text-dark mb-2 text-start mt-3"><span class=" badge bg-danger">Ditolak</span></span>
                    @endif
                            @foreach ($mohon as $aktiviti)
                                @if ($aktiviti->status === 2)
                                    <li class="list-group-item">
                                        <a href="#" style="display: none">{{{$aktiviti->nama}}}</a>
                                        <div class="d-flex justify-content-between">
                                            <div >
                                                <div class="d-flex justify-content-between">
                                                    <span class="fs-5 fw-bolder text-uppercase">{{{$aktiviti->nama}}}</span>
                                                    <span class="text-muted">
                                                        <em>
                                                            <span>(Dihantar kepada: </span>
                                                            <span><i class="fa-solid fa-at "></i></span>
                                                            <span> {{$aktiviti->kepada}})</span>
                                                        </em>
                                                    </span>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <div class="fs-6 d-flex justify-content-start">
                                                        <span><i class="fa-solid fa-circle-info" style="margin-top: 0.3em"></i></span>
                                                        <span class="ms-2">{{$aktiviti->cadangan_aktiviti}}</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end mt-2">
                                                    <div class="fs-6 d-flex justify-content-start gap-1">
                                                        <span class="badge bg-primary rounded-pill">{{$user->polikk}}</span>
                                                        <span class="badge bg-warning rounded-pill text-dark">{{$user->negeri}}</span>
                                                    </div>
                                                    
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </li>
                                @else
                                    @continue
                                @endif
                            @endforeach
                </ul>
                @else
                    <p>Tiada rekod permohonan aktiviti</p>
                            
                @endif
            </div>
        </div>
    </div>
</div>

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
</script>
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
@endsection
