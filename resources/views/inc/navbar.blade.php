<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top ">
  
    <div class="container-fluid">
      @guest
        @if (Route::has('login'))
        <a class="navbar-brand ms-2 fw-bolder " href="/">
          <img src="{{ URL:: asset('storage/prip.png') }}" alt="prip-logo" class="prip-logo">
        </a>
        @endif
      @endguest
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        @guest
          @if (Route::has('login'))
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
          </ul>
          @endif
  
          @else
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 mh-100">
            <a class="navbar-brand ms-2 fw-bolder" href="/home">
              <img src="{{ URL:: asset('storage/prip.png') }}" alt="prip-logo" class="prip-logo">
            </a>

          </ul>
       
        @endguest
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ms-auto me-1">
          <!-- Authentication Links -->
          @guest
              @if (Route::has('login'))
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('login') }}">{{ __('Log Masuk') }}</a>
                  </li>
              @endif
  
              @if (Route::has('register'))
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('register') }}">{{ __('Daftar') }}</a>
                  </li>
              @endif
          @else
              <li class="nav-item text-white">
                <a class="nav-link fs-5 text-white fw-bold" aria-current="page"><span class="px-3 text-uppercase fw-bolder me-3">
                  @if (Session::get('role') === '1')
                      Admin Sistem
                  @elseif (Session::get('role') === '2')
                      Pensyarah PRIP

                  @elseif (Session::get('role') === '4')
                      Calon PRIP

                  @else 
                      Pengguna
                  @endif
                </span></a>
            </li>
              <li class="nav-item">
                <a class="nav-link btn btn-primary text-white fw-bold" aria-current="page" href="/user"><span class="px-3 text-uppercase fw-bolder">{{Auth()->user()->name}}</span></a>
              </li>
              <li class="nav-item mx-2">
                <a class="nav-link fw-bold text-white border border-primary rounded-pill border-3" aria-current="page" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();"><span class="px-1"><i class="fa-solid fa-right-from-bracket fw-bolder"></i></span></a>
                              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                </a>
              </li>

          @endguest
      </ul>
      </div>
    </div>
  </nav>
  
  