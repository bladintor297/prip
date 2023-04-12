@extends('layouts.list')

@section('content')

<p class="text-center fs-6 mt-2 fs-1 fw-bold">Permohonan Aktiviti<br></p>
<p class="text-center fs-6 mt-2 fw-bold">{{$user->name}}<br></p>
<div class="container w-75">
    <div class="input-group mb-3">
        <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Cari aktiviti..." aria-label="Cari aktiviti" aria-describedby="basic-addon2">
    </div>

    @if (count($aktivitii)>0)
    <ul id="myUL" class="list-group" >

        @if (count($aktivitiL)>0)
            <span class="fs-6 fw-bolder text-dark mb-2 text-start mt-3"><span class=" badge bg-success">Diterima</span></span>
        @endif
                @foreach ($aktivitii as $aktiviti)
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
        
        @if (count($aktivitiB)>0)
            <span class="fs-6 fw-bolder text-dark mb-2 text-start mt-3"><span class=" badge bg-warning">Belum Diterima</span></span>
        @endif
                @foreach ($aktivitii as $aktiviti)
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

        @if (count($aktivitiT)>0)
            <span class="fs-6 fw-bolder text-dark mb-2 text-start mt-3"><span class=" badge bg-danger">Ditolak</span></span>
        @endif
                @foreach ($aktivitii as $aktiviti)
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
        <p>Tiada rekod aktiviti</p>
                
    @endif

    
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
</script>
@endsection
