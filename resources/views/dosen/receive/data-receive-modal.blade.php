<div class="modal-body detail-receive">
    <table class="table table-responsive">
        <tr>
          <th class="text-center">#</th>
          <th class="text-center">Surat</th>
        </tr>
        @foreach ($receives as $receive)
        <tr>
          <td class="text-center">{{ $loop->iteration }}</td>
          <td class="text-center">{{ $receive->surat->name }}</td>
          </td>
        </tr>
        @endforeach
    </table>
    <button class="btn btn-md btn-danger w-100 mt-2 fw-bold" id="reject-request-btn" data-id="{{ $receives[0]->slug }}"><i class="bi bi-send-slash"></i> Reject Request</button>
</div>