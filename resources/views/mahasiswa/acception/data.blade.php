@if ($acceptions->count() == 0)
    <div class="alert alert-danger mx-2 text-center" role="alert">
        No request is being processed!
    </div>
@else
    @foreach ($acceptions as $acception)
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="me-auto">
                        <h5 class="card-title text-capitalize">Request #{{ $acception->request_id }}</h5>
                    </div>
                    <div>
                        @if ($acception->status === 'unfinished')
                            <h5 class="card-title text-lowercase"><span class="badge text-bg-danger">{{ $acception->status }}</span></h5>
                        @else
                            <h5 class="card-title text-lowercase"><span class="badge text-bg-success">{{ $acception->status }}</span></h5>
                        @endif
                    </div>
                </div>
                <p class="card-text">Have {{ $acception->amount }} Surat in Progress!</p>
                <div class="row">
                    <div class="col-6">
                        <button class="btn btn-secondary w-100" id="detail-surat-button" data-id="{{ $acception->request_id }}"><i class="bi bi-list-columns"></i> Details</button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-primary w-100" id="request-surat" data-id="{{ $acception->request_id }}"><i class="bi bi-send-plus"></i> Request</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endif