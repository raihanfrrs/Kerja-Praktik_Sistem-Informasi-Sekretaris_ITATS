@if ($receives->count() == 0)
<div class="container-fluid pe-0">
  <div class="alert-custom alert-warning bg-warning rounded-3">
    <div class="alert-icon rounded-start">
      <i class="bi bi-send-exclamation"></i>
    </div>
    <div class="alert-text text-white">
      <h5 class="alert-heading text-white">Kosong</h5> 
      Belum ada permintaan surat yang masuk.
    </div>
  </div>
</div>
@else 
  @foreach ($receives as $receive)
  <div class="col-sm-6 col-md-6 col-lg-3">
    <div class="card bg-white p-3 mb-4">
      <div class="d-flex justify-content-between mb-4">
        <div class="user-info">
          <div class="user-info__img">
            @if ($receive->mahasiswa->image)
              <img src="{{ asset('storage/'. $receive->mahasiswa->image) }}" width="20" class="c-img-1" />
            @else
              <img src="{{ asset('/') }}assets/img/profile-img.jpg" width="20" class="c-img-1" />
            @endif
          </div>
          <div class="user-info__basic">
            <h5 class="mb-0">{{ $receive->mahasiswa->name }}</h5>
            <p class="text-muted mb-0">
              @if ($receive->mahasiswa->birthDate)
                {{\Carbon\Carbon::now()->diffInYears($receive->mahasiswa->birthDate) }} tahun,
              @endif
              @if ($receive->mahasiswa->gender === 'male')
                Laki-laki
              @else
                Perempuan
              @endif
            </p>
          </div>
        </div>
        <div class="dropdown">
          <button class="btn btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-three-dots"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end py-0" aria-labelledby="dropdownMenuButton">
            <li><a href="#" class="dropdown-item text-primary" id="detail-receive-button" data-id="{{ $receive->mahasiswa->slug }}"><i class="bi bi-list-columns"></i> Rincian</a></li>
          </ul>
        </div>
      </div>
      <h6 class="mb-0"><i class="bi bi-envelope"></i> {{ $receive->mahasiswa->email }}</h6>
      <a href="https://api.whatsapp.com/send?phone={{ contact($receive->mahasiswa->phone) }}" target="_blank" class="text-success" title="{{ $receive->mahasiswa->phone }}"><small><i class="bi bi-whatsapp"></i> Kontak</small></a>
      <div class="d-flex justify-content-between mt-4">
        <div>
          <h5 class="mb-0">{{ \Carbon\Carbon::createFromDate($receive->created_at)->format('H:i') }}
            <small class="ml-1">{{ \Carbon\Carbon::createFromDate($receive->created_at)->locale('id')->format('d F Y') }}</small>
          </h5>
        </div>
        <span class="fw-bold">
          <a href="#" class="text-success" id="accept-surat" data-id="{{ $receive->mahasiswa->slug }}" data-key="{{ $receive->request_id }}"><i class="bi bi-send-check"></i> Terima</a></span>
      </div>
    </div>
  </div>
  @endforeach
@endif