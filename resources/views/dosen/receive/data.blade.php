@if ($receives->count() == 0)
  <div class="alert alert-danger mx-2 text-center" role="alert">
    No Request Received!
  </div>
@else 
  @foreach ($receives as $receive)
  <div class="col-md-3">
      <div class="card">
          <div class="card-body">
            <h5 class="card-title">{{ $receive->mahasiswa->name }}</h5>
            <p class="card-text fw-bold">Have {{ $receive->amount }} surat request!</p>
            <h6 class="card-subtitle mb-2 text-muted">Last Requested {{\Carbon\Carbon::parse($receive->date)->diffForHumans() }}.</h6>
            <div class="row">
              <div class="col-6">
                  <a href="#" class="btn btn-secondary w-100" id="detail-surat-button"><i class="bi bi-list-columns"></i> Details</a>
              </div>
              <div class="col-6">
                  <button class="btn btn-primary w-100" id="accept-surat" data-id="{{ $receive->mahasiswa->slug }}"><i class="bi bi-send-check"></i> Accept</button>
              </div>
            </div>
          </div>
      </div>
  </div>
  @endforeach
@endif