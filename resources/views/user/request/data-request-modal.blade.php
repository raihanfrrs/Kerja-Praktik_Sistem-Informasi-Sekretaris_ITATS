<div class="modal-body">
    @if ($requests->count() == 0)
    <div class="alert alert-warning" role="alert">
        Permintaan Kosong!
    </div>
    @endif
    <table class="table">
        @foreach ($requests as $request)
        <tr>
            <th class="text-capitalize">{{ $request->surat->name }}</th>
            <td class="text-end"><button class="btn btn-sm btn-danger" title="Delete" id="delete-request" data-id="{{ $request->surat->slug }}"><i class="bi bi-send-dash-fill"></i></button></td>
        </tr>
        @endforeach
   </table>

   @if ($requests->count() != 0)
   <div class="d-flex justify-content-center">
    <button class="btn btn-md btn-primary text-center" id="submit-request-btn"><i class="bi bi-send-check"></i> Kirim Permintaan</button>
   </div>
   @endif
 </div>