<div class="card">
    <div class="card-body">

      <h5 class="card-title">Rincian <span>| Pengiriman</span></h5>

      <form action="/assignment/{{ $request->id }}" method="post" enctype="multipart/form-data">
        @csrf
        @foreach ($detail_requests as $detail_request)
          <div class="row py-3">
            <div class="col-5">
                <span class="fw-bold fs-4 text-capitalize">{{ $detail_request->name }}</span>
                <p class="text-muted text-capitalize">{{ $detail_request->jenis }}</p>
            </div>
            <div class="col-7">
              @if ($detail_request->request->status == 'rejected' || $detail_request->status == 'rejected')
                <div class="alert alert-danger d-flex justify-content-between align-items-center fs-6">
                  <span>Pengunggahan Kadaluarsa</span>
                  <i class="bi bi-folder-x"></i>
                </div>
              @else
                @if ($detail_request->temp_file || $detail_request->surat)
                  <div class="alert alert-filepond-success d-flex justify-content-between align-items-center alert-{{ $detail_request->id }} fs-6">
                    <span>Berhasil Mengunggah</span>
                    <i class="bi bi-folder-check"></i>
                  </div>
                @else
                    <input type="file" name="file" id="file" class="file-{{ $detail_request->id }} uploading" data-key="{{ $detail_request->id }}" data-id="{{ $detail_request->request_id }}">
                    <div class="alert alert-filepond-success d-flex justify-content-between align-items-center alert-{{ $detail_request->id }} fs-6 d-none">
                      <span>Berhasil Mengunggah</span>
                      <i class="bi bi-folder-check"></i>
                    </div>
                @endif
              @endif
            </div>
          </div>
        @endforeach

        @php
          $counter = 0;
          $done = 0;
          $rejected = 0;
        @endphp
        @foreach ($request->detail_request as $item)
            @if ($item->dosen_id == auth()->user()->dosen->id)
                @php $counter++ @endphp
            @endif

            @if ($item->status === 'done' && $item->dosen_id == auth()->user()->dosen->id)
                @php $done++ @endphp
            @endif

            @if ($item->status === 'rejected' && $item->dosen_id == auth()->user()->dosen->id)
                @php $rejected++ @endphp
            @endif
        @endforeach

        @if (($request->status != 'finished' && $request->status != 'rejected') && ($done !== $counter && $rejected !== $counter))
        <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Kirim</button>
      </form>
      <form action="/assignment/{{ $request->id }}" method="post" class="d-inline">
          @csrf
          @method('delete')
          <button type="submit" class="btn btn-danger"><i class="bi bi-escape"></i> Batalkan</button>
      </form>
        </div>
        @endif
    </div>
</div>