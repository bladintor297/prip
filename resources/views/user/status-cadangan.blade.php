@extends('layouts.list')

@section('content')

<p class="text-center fs-6 mt-2 fs-1 fw-bold">Permohonan Aktiviti<br></p>
<div class="container w-75">
    <ul class="nav nav-pills mb-3 justify-content-center mt-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link fs-4 fw-bold rounded-pill" id="pills-one-tab" data-bs-toggle="pill" data-bs-target="#pills-one" type="button" role="tab" aria-controls="pills-one" aria-selected="true">Belum Lulus</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fs-4 fw-bold rounded-pill" id="pills-two-tab" data-bs-toggle="pill" data-bs-target="#pills-two" type="button" role="tab" aria-controls="pills-two" aria-selected="false">Lulus</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fs-4 fw-bold rounded-pill" id="pills-three-tab" data-bs-toggle="pill" data-bs-target="#pills-three" type="button" role="tab" aria-controls="pills-three" aria-selected="false">Ditolak</button>
        </li>
    
        
    </ul>
    <div class="tab-content" id="pills-tabContent">
    
        {{-- One List --}}
        <div class="tab-pane fade " id="pills-one" role="tabpanel" aria-labelledby="pills-one-tab" tabindex="0">
            <div class="one-list">
                @if (count($aktivitiB)>0)
                    <ul id="myUL" class="list-group" >
                    @foreach ($aktivitiB as $aktiviti)
                        <li class="list-group-item">
                            <a href="#" style="display: none">{{{$aktiviti->nama}}}</a>
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="d-flex justify-content-between col-12">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold fs-6 mb-1 d-flex gap-3">{{$aktiviti->nama}}</div>
                                        <div class="d-flex text-muted"> 
                                            <span><i class="fa-solid fa-circle-info" style="margin-top: 0em"></i></span>
                                            <span class="ms-2">{{$aktiviti->cadangan_aktiviti}}</span>
                                        </div>
                                        
                                    </div>
                                </div>
                            
                            </div>
                            <div class="ms-2 me-auto d-flex justify-content-end mt-2">
                                <div>
                                    <span class="badge bg-primary rounded-pill">
                                        <em>
                                            <span>(Dihantar kepada: </span>
                                            <span><i class="fa-solid fa-at "></i></span>
                                            <span> {{$aktiviti->kepada}})</span>
                                        </em>
                                    </span>
                                </div>
                            </div>  
                        </li>
                    @endforeach
                    </ul>
                    
                @else
                    <p>Tiada rekod permohonan</p>
                @endif
            </div>
        </div>
    
        {{-- Two List --}}
        <div class="tab-pane fade show active" id="pills-two" role="tabpanel" aria-labelledby="pills-two-tab">
            <div class="two-list">
                @if (count($aktivitiL)>0)
                    <ul id="myUL" class="list-group" >
                    @foreach ($aktivitiL as $aktiviti)
                        <li class="list-group-item">
                            <a href="#" style="display: none">{{{$aktiviti->nama}}}</a>
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="d-flex justify-content-between col-12">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold fs-6 mb-1 d-flex gap-3">{{$aktiviti->nama}}
                                            <span><button class="badge rounded-pill px-4 bg-success opacity-75" disabled>Diterima</button></span>
                                        </div>
                                        <div class="d-flex text-muted"> 
                                            <span><i class="fa-solid fa-circle-info" style="margin-top: 0em"></i></span>
                                            <span class="ms-2">{{$aktiviti->cadangan_aktiviti}}</span>
                                        </div>
                                        
                                    </div>
                                </div>
                            
                            </div>
                            <div class="ms-2 me-auto d-flex justify-content-end mt-2">
                                <div>
                                    <span class="badge bg-primary rounded-pill">
                                        <em>
                                            <span>(Dihantar kepada: </span>
                                            <span><i class="fa-solid fa-at "></i></span>
                                            <span> {{$aktiviti->kepada}})</span>
                                        </em>
                                    </span>
                                </div>
                            </div>  
                        </li>
                    @endforeach
                    </ul>
                    
                @else
                    <p>Tiada rekod permohonan</p>
                @endif
            </div>
        </div>
    
        {{-- Three List --}}
        <div class="tab-pane fade" id="pills-three" role="tabpanel" aria-labelledby="pills-three-tab">
            <div class="three-list">
                @if (count($aktivitiT)>0)
                    <ul id="myUL" class="list-group" >
                    @foreach ($aktivitiT as $aktiviti)
                        <li class="list-group-item">
                            <a href="#" style="display: none">{{{$aktiviti->nama}}}</a>
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="d-flex justify-content-between col-12">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold fs-6 mb-1 d-flex gap-3">{{$aktiviti->nama}}
                                            <span><button class="badge rounded-pill px-4 bg-danger opacity-75" disabled>Ditolak</button></span>
                                        </div>
                                        <div class="d-flex text-muted"> 
                                            <span><i class="fa-solid fa-circle-info" style="margin-top: 0em"></i></span>
                                            <span class="ms-2">{{$aktiviti->cadangan_aktiviti}}</span>
                                        </div>
                                        
                                    </div>
                                </div>
                            
                            </div>
                            <div class="ms-2 me-auto d-flex justify-content-end mt-2">
                                <div>
                                    <span class="badge bg-primary rounded-pill">
                                        <em>
                                            <span>(Dihantar kepada: </span>
                                            <span><i class="fa-solid fa-at "></i></span>
                                            <span> {{$aktiviti->kepada}})</span>
                                        </em>
                                    </span>
                                </div>
                            </div>  
                        </li>
                    @endforeach
                    </ul>
                    
                @else
                    <p>Tiada rekod permohonan</p>
                @endif
            </div>
        </div>
    
    
    </div>
    <a class="btn btn-warning px-4 floating-btn rounded-pill" href ="/aktiviti/create">
        <i class="fa-brands fa-plus"></i>
        Aktiviti Baru
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
@endsection
