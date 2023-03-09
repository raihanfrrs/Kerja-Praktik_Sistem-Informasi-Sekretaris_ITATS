@if ($receives->count() == 0)
  <div class="alert alert-danger mx-2 text-center" role="alert">
    No Request Received!
  </div>
@else 
  @foreach ($receives as $receive)
  <div class="col-md-4">
      <div class="card">
          <div class="card-body">
            <div class="d-flex">
              <div class="flex-grow-1"><h5 class="card-title fw-bold">Request #{{ $loop->iteration }}</h5></div>
              <div><h6 class="card-title text-muted">{{\Carbon\Carbon::parse($receive->date)->diffForHumans() }}.</h6></div>
            </div>
            <table style="width:100%" class="mb-4">
              <tr>
                <th class="fw-normal">Name</th>
                <td class="text-end fw-bold">{{ $receive->mahasiswa->name }}</td>
              </tr>
              <tr>
                <th class="fw-normal">Phone</th>
                <td class="text-end fw-bold fst-italic">{{ $receive->mahasiswa->phone }}</td>
              </tr>
              <tr>
                <th class="fw-normal">Email</th>
                <td class="text-end fw-bold fst-italic">{{ $receive->mahasiswa->email }}</td>
              </tr>
              <tr>
                <th class="fw-normal">Amount</th>
                <td class="text-end fw-bold">{{ $receive->amount }} Surat</td>
              </tr>
            </table>
            <div class="row">
              <div class="col-6">
                  <a href="#" class="btn btn-secondary w-100" id="detail-receive-button" data-id="{{ $receive->mahasiswa->slug }}"><i class="bi bi-list-columns"></i> Details</a>
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