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
                  <li><a href="/assignment/{{ $assign->id }}" class="dropdown-item text-primary"><i class="bi bi-file-text"></i> Rincian</a></li>
              @elseif ($assign->status === 'done')
                  <li><a href="/assignment/{{ $assign->id }}" class="dropdown-item text-primary"><i class="bi bi-file-text"></i> Rincian</a></li>
              @elseif ($assign->status === 'accepted')
                  <li><button class="dropdown-item text-danger" id="reject-assignment-btn" data-id="{{ $assign->id }}"><i class="bi bi-send-slash"></i> Tolak</button></li>
                  <li><a href="/assignment/{{ $assign->id }}" class="dropdown-item text-success"><i class="bi bi-send"></i> Kirim</a></li>
              @endif
            </ul>
          </div>
        </div>
      </div>
      <div class="px-3 pt-3">
        <h3 class="name">{{ $assign->user->level === 'mahasiswa' ? $assign->user->mahasiswa->name : $assign->user->dosen->name }}</h3>
        <p class="quote2">Melakukan permintaan pada {{\Carbon\Carbon::parse($assign->date)->diffForHumans() }}.</p>
      </div>
      <div class="d-flex justify-content-start px-3 align-items-center">
        <i class="mdi mdi-view-comfy task"></i>
        <span class="quote2 pl-2">Email: {{ $assign->user->level === 'mahasiswa' ? $assign->user->mahasiswa->email : $assign->user->dosen->email }}</span>
      </div>
      <div class="d-flex justify-content-start px-3 align-items-center">
        <i class="mdi mdi-view-comfy task"></i>
        <span class="quote2 pl-2">Nomor HP: <a href="https://api.whatsapp.com/send?phone={{ contact($assign->user->level === 'mahasiswa' ? $assign->user->mahasiswa->phone : $assign->user->dosen->phone) }}" target="_blank" class="text-success" title="{{ $assign->user->level === 'mahasiswa' ? $assign->user->mahasiswa->phone : $assign->user->dosen->phone }}"><i class="bi bi-whatsapp"></i> WhatsApp</a></span>
      </div>
      <div class="d-flex justify-content-between  px-3 align-items-center pb-3">
        <div class="d-flex justify-content-start align-items-center">
          <i class="mdi mdi-calendar-clock date"></i>
          <span class="quote2 pl-2">Status: 
            @if ($assign->status === 'accepted')
              <span class="badge rounded-pill text-bg-primary">Proses</span>
            @elseif ($assign->status === 'rejected')
              <span class="badge rounded-pill text-bg-danger">Ditolak</span>
            @elseif ($assign->status === 'done') 
              <span class="badge rounded-pill text-bg-success">Selesai</span>
            @endif
          </span>
        </div>
      <div class="d-flex justify-content-end">
        @if ($assign->user->level === 'mahasiswa')
          @if ($assign->user->mahasiswa->image)
            <img src="{{ asset('storage/'. $assign->user->mahasiswa->image) }}" width="20" class="c-img-1" />
          @else
            <img src="{{ asset('/') }}assets/img/profile-img.jpg" width="20" class="c-img-1" />
          @endif
        @elseif ($assign->user->level === 'dosen') 
          @if ($assign->user->dosen->image)
            <img src="{{ asset('storage/'. $assign->user->dosen->image) }}" width="20" class="c-img-1" />
          @else
            <img src="{{ asset('/') }}assets/img/profile-img.jpg" width="20" class="c-img-1" />
          @endif
        @endif
      </div>
      </div>
    </div>
  </div>
  @endforeach
@endif