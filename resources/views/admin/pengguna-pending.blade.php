@extends('layouts.list')
@section('content')

<div class="container w-75">
    
    <ul class="nav nav-pills justify-content-center mt-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link fs-4 fw-bold rounded-pill" id="pills-one-tab" data-bs-toggle="pill" data-bs-target="#pills-one" type="button" role="tab" aria-controls="pills-one" aria-selected="true">PRIP Baru ({{count($prips)}})</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link fs-4 fw-bold rounded-pill" id="pills-two-tab" data-bs-toggle="pill" data-bs-target="#pills-two" type="button" role="tab" aria-controls="pills-two" aria-selected="false">Tamat Lantikan ({{count($expired)}})</button>
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
            <div class="pending-list">
                @if (count($prips)>0)
                    <ul id="myUL2" class="list-group mb-4">
                        @foreach ($prips as $prip)
                        <li class="list-group-item">
                            <a href="#" style="display: none">{{$prip->name}}</a>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <span class="fs-5 fw-bolder text-uppercase">{{$prip->name}} 
                                        <span class="badge bg-primary">
                                            @if ($prip->role === '1')
                                                Admin
                                            @elseif ($prip->role === '2')
                                                PRIP 
                                            @else
                                                Pengguna 
                                            @endif</span>
                                    </span>
                                    <div class="fs-6 text-muted"><i class="fa-solid fa-at ms-2"></i> {{$prip->email}}</div>
                                </div>
                                <div>
                                    <button class="badge bg-success rounded-pill fs-6 px-3"><a href="/admin/{{$prip->id}}/edit" class="text-decoration-none text-white ">Terima</a></button>
                                    <button class="badge bg-danger rounded-pill fs-6 px-2"><a href="/admin/{{$prip->id}}/reject" class="text-decoration-none  text-white">Tolak</a></button>
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
    
        {{-- Expired List --}}
        <div class="tab-pane fade  show active" id="pills-two" role="tabpanel" aria-labelledby="pills-two-tab">
            <div class="sticky-lg-top pt-5 mb-2">
                <div class="card bg-white mt-3">
                    <p class="text-center fs-6 mt-2 fs-1 fw-bold ">Tamat Lantikan<br></p>
                    <div class="input-group mb-3 ms-2 ">
                        <input type="text" class="form-control me-1" id="myInput2" onkeyup="myFunction2()" placeholder="Carian PRIP...." aria-label="Cari PRIP...." aria-describedby="basic-addon2">
                    </div>
                </div>
            </div>
            <div class="prip-list">
                @if (count($expired)>0)
                    <ul id="myUL2" class="list-group mb-4">
                        @foreach ($expired as $prip)
                        <li class="list-group-item">
                            <a href="#" style="display: none">{{$prip->name}}</a>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <span class="fs-5 fw-bolder text-uppercase">{{$prip->name}} 
                                        <span class="badge bg-primary">
                                            @if ($prip->role === '1')
                                                Admin
                                            @elseif ($prip->role === '2')
                                                PRIP 
                                            @else
                                                Pengguna 
                                            @endif</span>
                                    </span>
                                    <div class="fs-6 text-muted"><i class="fa-solid fa-at ms-2"></i> {{$prip->email}}</div>
                                </div>
                                <div>
                                    <button class="badge bg-success rounded-pill fs-6 px-3" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{$prip->id}}">Lantikan Baharu</button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{$prip->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            {!! Form::open(['action' => ['\App\Http\Controllers\PRIPController@update', $prip->id], 'method'=>'PUT','enctype' => 'multipart/form-data']) !!}
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Kemaskini Lantikan</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            Adakah anda bersetuju untuk mengemaskini Sesi Lantikan PRIP <b>{{$prip->name}}</b>? <br><br>

                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Sesi Lantikan</th>
                                                        <td class="d-flex gap-2">
                                                            {{Form::select('bulan_lantikan', [
                                                                'Januari' => 'Januari',
                                                                'Februari' => 'Februari',
                                                                'Mac' => 'Mac',
                                                                'April' => 'April',
                                                                'Mei' => 'Mei',
                                                                'Jun' => 'Jun',
                                                                'Julai' => 'Julai',
                                                                'Ogos' => 'Ogos',
                                                                'September' => 'September',
                                                                'Oktober' => 'Oktober',
                                                                'November' => 'November',
                                                                'Disember' => 'Disember',
                                                            ], $prip->bulan_lantikan, ['class'=> 'form-select text-uppercase', 'id' => 'bulan_lantikan', 'style'=>'width:40%',  'onchange' =>'copyTextValue(this)']);}}
                                                            <select type="text" class="form-select" style="width: 30%">
                                                                <option value="{{date('Y') - 1}}" selected>{{date('Y') - 1}}</option>
                                                                <option value="{{date('Y')}}" selected>{{date('Y')}}</option>
                                                            </select>
                                                            
                                                        </td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="col">Tamat Lantikan</th>
                                                        
                                                        <td class="d-flex gap-2">
                                                            <input type="text" class="form-select text-uppercase" id="bulan_tamat"  style="width: 40%" disabled>
                                                            <input type="text" class="form-select" value="{{date('Y')+2}}" style="width: 30%" disabled>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Kemaskini</button>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                        </div>
                                    </div>
                                    

                                    <button class="badge bg-warning rounded-pill fs-6 px-2"><a href="/aktiviti-prip/{{$prip->id}}" class="text-decoration-none  text-dark">Butiran</a></button>
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
    

    </div>
    <script>
        function copyTextValue(bf) {
            var text1 = document.getElementById("bulan_lantikan").value;
            document.getElementById("bulan_tamat").value = text1;
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