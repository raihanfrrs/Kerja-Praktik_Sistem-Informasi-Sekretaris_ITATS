<div class="modal-body detail-surat">
   <span class="fs-5"><b>Overview</b> <i class="bi bi-exclamation-circle"></i></span>
   <table class="table">
      <tr>
        <th>Surat</th>
        <td>{{ $surat->name }}</td>
      </tr>
      <tr>
        <th>Kategori</th>
        <td>{{ $surat->jenis_surat->jenis }}</td>
      </tr>
      <tr>
        <th>Deskripsi</th>
        <td>{!! $surat->description !!}</td>
      </tr>
  </table>
</div>