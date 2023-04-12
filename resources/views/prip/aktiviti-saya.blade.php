@extends('layouts.list')

@section('content')

<p class="text-center fs-6 mt-2 fs-1 fw-bold">Aktiviti Saya<br></p>
<div class="container w-75">
    <div class="input-group mb-3">
        <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Cari aktiviti..." aria-label="Cari aktiviti" aria-describedby="basic-addon2">
    </div>

    

    @if (count($aktivitii)>0)
    <ul id="myUL" class="list-group" >
        @if (count($aktivitiL)>0)
            <span class="fw-bolder mb-2 text-start" ><span class="badge bg-warning rounded-pill px-3 text-dark ">Lulus</span></span>
        @endif
        
                @foreach ($aktivitii as $aktiviti)
                    @if ($aktiviti->status === 1)
                    
                        <li class="list-group-item">
                            <a href="#" style="display: none">{{{$aktiviti->nama}}}</a>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <span class="fs-6 fw-bolder text-uppercase">{{{$aktiviti->nama}}}</span>
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
            <span class="fw-bolder mb-2 text-start" ><span class="badge bg-warning rounded-pill px-3 text-dark ">Belum Lulus</span></span>
        @endif
                @foreach ($aktivitii as $aktiviti)
                    @if ($aktiviti->status === 0)
                        <li class="list-group-item">
                            <a href="#" style="display: none">{{{$aktiviti->nama}}}</a>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <span class="fs-6 fw-bolder text-uppercase">{{{$aktiviti->nama}}}</span>
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
    </ul>
    @else
        <p>Tiada rekod aktiviti</p>
                
    @endif

    <a class="btn btn-warning px-4 floating-btn rounded-pill" href ="/aktiviti/create">
        <i class="fa-brands fa-plus"></i>
        Tambah Aktiviti
    </a>
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
