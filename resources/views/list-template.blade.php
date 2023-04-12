<ul class="nav nav-pills mb-3 justify-content-center mt-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link fs-4 fw-bold rounded-pill" id="pills-one-tab" data-bs-toggle="pill" data-bs-target="#pills-one" type="button" role="tab" aria-controls="pills-one" aria-selected="true">Pengguna</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link fs-4 fw-bold rounded-pill" id="pills-two-tab" data-bs-toggle="pill" data-bs-target="#pills-two" type="button" role="tab" aria-controls="pills-two" aria-selected="false">PRIP</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link fs-4 fw-bold rounded-pill" id="pills-three-tab" data-bs-toggle="pill" data-bs-target="#pills-three" type="button" role="tab" aria-controls="pills-three" aria-selected="false">Admin</button>
    </li>

    
  </ul>
  <div class="tab-content" id="pills-tabContent">

    {{-- One List --}}
    <div class="tab-pane fade show active" id="pills-one" role="tabpanel" aria-labelledby="pills-one-tab" tabindex="0">
        <div class="one-list">
          @if (count($aktivitiL)>0)
            @foreach ($aktivitiL as $aktiviti)
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
            @endforeach
              
          @else
              <p>Tiada rekod permohonan</p>
          @endif
        </div>
    </div>

    {{-- Two List --}}
    <div class="tab-pane fade" id="pills-two" role="tabpanel" aria-labelledby="pills-two-tab">
        <div class="two-list">
            
        </div>
    </div>

    {{-- Three List --}}
    <div class="tab-pane fade" id="pills-three" role="tabpanel" aria-labelledby="pills-three-tab">
        <div class="three-list">

        </div>
    </div>


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