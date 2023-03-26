<div class="card">
    <div class="card-body">

      <h5 class="card-title">Detail <span>| Assignment</span></h5>

      <form action="/assignment/{{ $request->id }}" method="post" enctype="multipart/form-data">
        @csrf
        @foreach ($detail_requests as $detail_request)
          <div class="row py-3">
            <div class="col-5">
                <span class="fw-bold fs-4 text-capitalize">{{ $detail_request->name }}</span>
                <p class="text-muted text-capitalize">{{ $detail_request->jenis }}</p>
            </div>
            <div class="col-7">
              @if ($detail_request->temp_file || $detail_request->surat)
                <div class="alert alert-filepond-success d-flex justify-content-between align-items-center alert-{{ $detail_request->id }} fs-6">
                  <span>Upload Complete</span>
                  <i class="bi bi-folder-check"></i>
                </div>
              @else
                  <input type="file" name="file" id="file" class="file-{{ $detail_request->id }} uploading" data-key="{{ $detail_request->id }}" data-id="{{ $detail_request->request_id }}">
                  <div class="alert alert-filepond-success d-flex justify-content-between align-items-center alert-{{ $detail_request->id }} fs-6 d-none">
                    <span>Upload Complete</span>
                    <i class="bi bi-folder-check"></i>
                  </div>
              @endif
            </div>
          </div>
        @endforeach

        @if ($request->status != 'finished')
        <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Submit</button>
        </div>
        @endif
      </form>

    </div>
</div>