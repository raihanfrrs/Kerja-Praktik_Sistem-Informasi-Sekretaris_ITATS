@if ($assigns->count() == 0)
<div class="container-fluid pe-0">
  <div class="alert-custom alert-warning bg-warning rounded-3">
    <div class="alert-icon rounded-start">
      <i class="bi bi-send-exclamation"></i>
    </div>
    <div class="alert-text text-white">
      <h5 class="alert-heading text-white">Kosong</h5> 
      Belum ada surat yang ditugaskan.
    </div>
  </div>
</div>
@else 
  @foreach ($assigns as $assign)
  <div class="col-md-3">
    <div class="c-card-2 mb-4">
      <div class="px-3 pt-2">
        <div class="d-flex justify-content-between">
          <div class="d-flex flex-row align-items-center">
            <div class="round">
              <img src="{{ asset('/') }}assets/img/mail.png" width="23" class="imgfix"/>
            </div>
          </div>
          <div class="dropdown">
            <button class="btn btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-three-dots"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end py-0" aria-labelledby="dropdownMenuButton">
              @if ($assign->status === 'rejected')
                  <li><a href="/assignment/{{ $assign->id }}" class="dropdown-item text-primary"><i class="bi bi-file-text"></i> Detail</a></li>
              @elseif ($assign->status === 'done')
                  <li><a href="/assignment/{{ $assign->id }}" class="dropdown-item text-primary"><i class="bi bi-file-text"></i> Detail</a></li>
              @elseif ($assign->status === 'accepted')
                  <li><button class="dropdown-item text-danger" id="reject-assignment-btn" data-id="{{ $assign->mahasiswa->slug }}"><i class="bi bi-send-slash"></i> Rejected</button></li>
                  <li><a href="/assignment/{{ $assign->id }}" class="dropdown-item text-success"><i class="bi bi-send"></i> Send</a></li>
              @endif
            </ul>
          </div>
        </div>
      </div>
      <div class="px-3 pt-3">
        <h3 class="name">{{ $assign->mahasiswa->name }}</h3>
        <p class="quote2">These cuties will need a new place where thay can live with their owner.</p>
      </div>
      <div class="d-flex justify-content-start px-3 align-items-center">
        <i class="mdi mdi-view-comfy task"></i>
        <span class="quote2 pl-2">Email: {{ $assign->mahasiswa->email }}</span>
      </div>
      <div class="d-flex justify-content-start px-3 align-items-center">
        <i class="mdi mdi-view-comfy task"></i>
        <span class="quote2 pl-2">Phone: <a href="https://api.whatsapp.com/send?phone={{ contact($assign->mahasiswa->phone) }}" target="_blank" class="text-success" title="{{ $assign->mahasiswa->phone }}"><i class="bi bi-whatsapp"></i> WhatsApp</a></span>
      </div>
      <div class="d-flex justify-content-between  px-3 align-items-center pb-3">
        <div class="d-flex justify-content-start align-items-center">
          <i class="mdi mdi-calendar-clock date"></i>
          <span class="quote2 pl-2">Status: 
            @if ($assign->status === 'accepted')
              <span class="badge rounded-pill text-bg-primary">{{ $assign->status }}</span>
            @elseif ($assign->status === 'rejected')
              <span class="badge rounded-pill text-bg-danger">{{ $assign->status }}</span>
            @elseif ($assign->status === 'done') 
              <span class="badge rounded-pill text-bg-success">Finished</span>
            @endif
          </span>
        </div>
      <div class="d-flex justify-content-end">
        @if ($assign->mahasiswa->image)
          <img src="{{ asset('storage/'. $assign->mahasiswa->image) }}" width="20" class="c-img-1" />
        @else
          <img src="{{ asset('/') }}assets/img/profile-img.jpg" width="20" class="c-img-1" />
        @endif
      </div>
      </div>
    </div>
  </div>
  @endforeach
@endif