<a href="/mahasiswa/{{ $model->slug }}/edit" class="btn btn-sm btn-warning" title="Ubah"><i class="bi bi-pen"></i></a>
<a href="/mahasiswa/{{ $model->slug }}" class="btn btn-sm btn-primary" title="Rincian"><i class="bi bi-eye"></i></a>

<form action="/mahasiswa/{{ $model->slug }}" class="d-inline" method="post">
    @method('put')
    @csrf
    <button title="{{ $model->status == 'approved' ? 'TIDAK DISETUJUI' : 'DISETUJUI' }}" name="status" value="checked" class="btn btn-sm btn-{{ $model->status == 'approved' ? 'danger' : 'success' }}" ><i class="{{ $model->status == 'approved' ? 'bi bi-x-circle' : 'bi bi-check-circle' }}"></i></button>
</form>