<div class="modal-body detail-surat">
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