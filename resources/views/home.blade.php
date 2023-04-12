@extends('layouts.app')

@section('content')

@if (Session::get('status') === 0)
  <script>
    alert('Pendaftaran anda telah diterima. Sila tunggu sementara akaun anda disahkan oleh admin sistem.')
  </script>
  @php Auth::logout();  @endphp
  <script>location.reload();</script>

@else
<p class="text-center fs-6 mt-2 fs-1 fw-bold">Sistem Pensyarah Rujukan Item Penilaian (PRIP) <br></p>
  @if (Session::get('role') === '1')
    <div class="container border">
      <p class="fs-4 fw-bold text-center mt-3 text-decoration-underline">RINGKASAN LAPORAN PRIP</p>

      <div class="row mt-2">
      <p class="fs-5 fw-bold ms-2 ">Laporan Keseluruhan ({{date('Y', strtotime($minYear))}} - {{date('Y', strtotime($maxYear))}})</p>
        <div class="col-xl-4 col-sm-6 col-12 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between px-md-1">
                <div>
                  <h3 class="text-warning fw-bolder">{{count($prip)}} orang</h3>
                  <p class="mb-0">Jumlah Pensyarah PRIP</p>
                </div>
                <div class="align-self-center">
                  <i class=" text-warning fa-solid fa-person-chalkboard fa-3x"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 col-12 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between px-md-1">
                <div>
                  <h3 class="text-success fw-bolder">{{count($aktiviti)}} Aktiviti</h3>
                  <p class="mb-0">Telah Dilaksanakan</p>
                </div>
                <div class="align-self-center">
                  <i class="fa-solid fa-list-check text-success fa-3x"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 col-12 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between px-md-1">
                <div>
                  <h3 class="text-danger fw-bolder">{{$peserta}} orang</h3>
                  <p class="mb-0">Jumlah Peserta</p>
                </div>
                <div class="align-self-center">
                  <i class="fa-solid fa-users-line text-danger  fa-3x"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="row mt-2">
        <div class="col-12 d-flex justify-content-between">
          <p class="fs-5 fw-bold ms-2">Laporan Tahunan</p>
          <div class=" mb-3" id="filter" >

            {!! Form::open(['action' => '\App\Http\Controllers\HomeController@update', 'method'=>'GET','enctype' => 'multipart/form-data']) !!}
              <div class="input-group d-flex">
                <select class="form-select" name="tahun" aria-label="Default select example">
                  <option disabled selected>- Pilih Tahun -</option>
                    @for ($i = date('Y', strtotime($minYear)); $i <= date('Y', strtotime($maxYear)); ++$i)                
                      
                      @if ($i == Session::get('tahun'))
                        <option value="{{$i}}" selected>{{$i}}</option>
                      
                      @else
                        <option value="{{$i}}">{{$i}}</option>
                      @endif
                    @endfor
                </select>
                    <button class="btn btn-primary fw-bold" type="submit">Lihat </button>
              </div>
            {!! Form::close() !!} 
          </div>

        </div>

        <div class="col-xl-4 col-sm-6 col-12 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between px-md-1">
                <div>
                  <h3 class="text-warning fw-bolder">{{count($prip_tahunan)}} orang</h3>
                  <p class="mb-0">Jumlah Pensyarah PRIP</p>
                </div>
                <div class="align-self-center">
                  <i class=" text-warning fa-solid fa-person-chalkboard fa-3x"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 col-12 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between px-md-1">
                <div>
                  <h3 class="text-success fw-bolder">{{count($aktiviti_tahunan)}} Aktiviti</h3>
                  <p class="mb-0">Telah Dilaksanakan</p>
                </div>
                <div class="align-self-center">
                  <i class="fa-solid fa-list-check text-success fa-3x"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 col-12 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between px-md-1">
                <div>
                  <h3 class="text-danger fw-bolder">{{$peserta_tahunan}} orang</h3>
                  <p class="mb-0">Jumlah Peserta</p>
                </div>
                <div class="align-self-center">
                  <i class="fa-solid fa-users-line text-danger  fa-3x"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-1 row-cols-1 row-cols-md-2 g-4 text-center justify-content-center">
      <div class="col">
        <a href='/prip' class="text-decoration-none opt">
          <div class="card mb-3 opt-card">
              <div class="card-body mt-2">
                  <h5 class="card-title"><i class="fa-solid fa-arrows-down-to-people opt-icon"></i></h5>
                  <p class="card-text">Urus Pengguna</p>
              </div>
            </div>
        </a>
      </div>
      
      <div class="col">
        <a href='/aktiviti' class="text-decoration-none opt">
          <div class="card mb-3 opt-card">
              <div class="card-body mt-2">
                  <h5 class="card-title"><i class="fa-solid fa-envelopes-bulk opt-icon"></i></h5>
                  <p class="card-text">Urus Aktiviti</p>
              </div>
            </div>
        </a>
      </div>

      <div class="col">
        <a href='/modul' class="text-decoration-none opt">
          <div class="card mb-3 opt-card">
              <div class="card-body mt-2">
                  <h5 class="card-title">
                    <i class="fa-solid fa-cubes-stacked opt-icon"></i></h5>
                  <p class="card-text">Urus Modul</p>
              </div>
            </div>
        </a>
      </div>
    </div>

    @elseif (Session::get('role') === '2')

    @if (Session::get('status') === 2)
      <script>
        alert('Tempoh lantikan anda sudah tamat. Sila berhubung dengan pihak urusetia di BPN.')
      </script>
    @endif
    <div class="row mt-5">
      <div class="col-xl-4 col-sm-6 col-12 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between px-md-1">
              <div>
                <h3 class="text-success fw-bolder">{{App\Http\Controllers\AktivitiController::kiraAktiviti(Auth::id())}} aktiviti</h3>
                <p class="mb-0">Telah Dilaksanakan</p>
              </div>
              <div class="align-self-center">
                <i class="fa-solid fa-list-check text-success fa-3x"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-sm-6 col-12 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between px-md-1">
              <div>
                <h3 class="text-warning fw-bolder">{{App\Http\Controllers\AktivitiController::kiraHari(Auth::id())}} hari</h3>
                <p class="mb-0">Jumlah kumulatif hari</p>
              </div>
              <div class="align-self-center">
                <i class="fa-solid fa-calendar-day text-warning  fa-3x"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-sm-6 col-12 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between px-md-1">
              <div>
                <h3 class="text-danger fw-bolder">{{App\Http\Controllers\AktivitiController::kiraPeserta(Auth::id())}} orang</h3>
                <p class="mb-0">Jumlah Peserta</p>
              </div>
              <div class="align-self-center">
                <i class="fa-solid fa-users-line text-danger  fa-3x"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-1 row-cols-1 row-cols-md-2 g-4 text-center">
      <div class="col">
        <a href='/aktiviti' class="text-decoration-none opt">
          <div class="card mb-3 opt-card">
              <div class="card-body mt-2">
                  <h5 class="card-title"><i class="fa-solid fa-list-ol opt-icon"></i></i></h5>
                  <p class="card-text">Aktiviti Saya</p>
              </div>
            </div>
        </a>
      </div>
      <div class="col">

        @if (Session::get('status') === 2)
        <a href='/mohon-aktiviti/{{Auth::id()}}' class="text-decoration-none opt disabled">

        @else
        <a href='/mohon-aktiviti/{{Auth::id()}}' class="text-decoration-none opt">
        @endif

          {{-- <a href='/aktiviti/create' class="text-decoration-none opt"> --}}
          <div class="card mb-3 opt-card">
              <div class="card-body mt-2">
                  <h5 class="card-title"><i class="fa-solid fa-plus opt-icon"></i></h5>
                  <p class="card-text">Permohonan Aktiviti</p>
              </div>
            </div>
        </a>
      </div>
    </div>

    @elseif(Session::get('role') === '4')
    <div class="row mt-1 row-cols-1 row-cols-md-2 g-4 text-center">
      <div class="col">
        <a href='/prip' class="text-decoration-none opt">
          <div class="card mb-3 opt-card">
              <div class="card-body mt-2">
                  <h5 class="card-title"><i class="fa-solid fa-list-ol opt-icon"></i></i></h5>
                  <p class="card-text">Status Modul</p>
              </div>
            </div>
        </a>
      </div>
      
    </div>

    @else
    <div class="row mt-1 row-cols-1 row-cols-md-2 g-4 text-center">
      <div class="col">
        <a href='/prip' class="text-decoration-none opt">
          <div class="card mb-3 opt-card">
              <div class="card-body mt-2">
                  <h5 class="card-title"><i class="fa-solid fa-list-ol opt-icon"></i></i></h5>
                  <p class="card-text">Senarai PRIP</p>
              </div>
            </div>
        </a>
      </div>
      <div class="col">
        <a href='/mohon-aktiviti/{{Auth::id()}}' class="text-decoration-none opt">
          <div class="card mb-3 opt-card">
              <div class="card-body mt-2">
                  <h5 class="card-title"><i class="fa-solid fa-envelope opt-icon"></i></h5>
                  <p class="card-text">Permohonan Aktiviti</p>
              </div>
            </div>
        </a>
      </div>
    </div>
    @endif
@endif

@endsection
