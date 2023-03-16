@if ($assigns->count() == 0)
  <div class="alert alert-danger mx-2 text-center" role="alert">
    No Request Assigned!
  </div>
@else 
  @foreach ($assigns as $assign)
  <div class="col-md-4">
      <div class="card">
          <div class="card-body">
            <div class="d-flex">
              <div class="flex-grow-1"><h5 class="card-title fw-bold">Request ID#{{ $assign->id }}</h5></div>
              <div><h6 class="card-title text-muted">{{\Carbon\Carbon::parse($assign->date)->diffForHumans() }}.</h6></div>
            </div>
            <table style="width:100%" class="mb-4">
              <tr>
                <th class="fw-normal">Name</th>
                <td class="text-end fw-bold">{{ $assign->mahasiswa->name }}</td>
              </tr>
              <tr>
                <th class="fw-normal">Phone</th>
                <td class="text-end fw-bold fst-italic">{{ $assign->mahasiswa->phone }}</td>
              </tr>
              <tr>
                <th class="fw-normal">Email</th>
                <td class="text-end fw-bold fst-italic">{{ $assign->mahasiswa->email }}</td>
              </tr>
              <tr>
                <th class="fw-normal">Status</th>
                <td class="text-end fw-bold text-capitalize">
                  @if ($assign->status === 'accepted')
                    <span class="badge rounded-pill text-bg-primary">{{ $assign->status }}</span>
                  @elseif ($assign->status === 'rejected')
                    <span class="badge rounded-pill text-bg-danger">{{ $assign->status }}</span>
                  @elseif ($assign->status === 'finished') 
                    <span class="badge rounded-pill text-bg-success">{{ $assign->status }}</span>
                  @endif
                </td>
              </tr>
            </table>
            <div class="row">
              @if ($assign->status === 'rejected')
                <div class="col-12">
                  <a href="/" class="btn btn-secondary w-100"><i class="bi bi-file-text"></i> Detail</a>
                </div>
              @elseif ($assign->status === 'accepted')
                <div class="col-6">
                  <button class="btn btn-danger w-100" id="reject-assign-btn" data-id="{{ $assign->mahasiswa->slug }}"><i class="bi bi-send-slash"></i> Rejected</button>
                </div>
                <div class="col-6">
                  <button class="btn btn-primary w-100"><i class="bi bi-send"></i> Send</button>
                </div>
              @endif
            </div>
          </div>
      </div>
  </div>
  @endforeach
@endif