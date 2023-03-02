@foreach ($surats as $surat)
    <div class="col-md-3">
        <div class="card">
            <div class="card-body" >
                <h5 class="card-title text-capitalize">{{ $surat->name }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{ $surat->jenis_surat->jenis }}</h6>
                <p class="card-text">{{ Str::limit(strip_tags($surat->description), 100) }}</p>
                <div class="row">
                    <div class="col-6">
                        <button class="btn btn-secondary w-100" id="detail-surat-button" data-id="{{ $surat->slug }}"><i class="bi bi-list-columns"></i> Details</button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-primary w-100" id="request-surat" data-id="{{ $surat->slug }}"><i class="bi bi-send-plus"></i> Request</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach