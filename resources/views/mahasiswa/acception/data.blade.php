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
                        <h5 class="card-title text-capitalize fw-bold">Request #{{ $acception->request_id }}</h5>
                    </div>
                    <div>
                        @if ($acception->status === 'unfinished')
                            <h5 class="card-title"><span class="badge text-bg-warning">Pending</span></h5>
                        @elseif ($acception->status === 'processed')
                            <h5 class="card-title"><span class="badge text-bg-primary">Processed</span></h5>
                        @elseif ($acception->status === 'finished')
                            <h5 class="card-title"><span class="badge text-bg-success">Finished</span></h5>
                        @elseif ($acception->status === 'canceled' || $acception->status === 'rejected')
                            <h5 class="card-title text-capitalize"><span class="badge text-bg-danger">{{ $acception->status }}</span></h5>
                        @endif
                    </div>
                </div>
                <p class="card-text">Have {{ $acception->amount }} surat in request!</p>
                <div class="row">
                    @if ($acception->status === 'unfinished')
                        <div class="col-6">
                            <button class="btn btn-secondary w-100" id="" data-id="{{ $acception->request_id }}"><i class="bi bi-list-columns"></i> Details</button>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-danger w-100" id="cancel-surat-btn" data-id="{{ $acception->request_id }}"><i class="bi bi-send-slash"></i> Cancel</button>
                        </div>
                    @else
                        <div class="col-12">
                            <button class="btn btn-secondary w-100" id="" data-id="{{ $acception->request_id }}"><i class="bi bi-list-columns"></i> Details</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endif