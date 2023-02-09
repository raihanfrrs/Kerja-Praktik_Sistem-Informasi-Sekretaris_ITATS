<a href="/mahasiswa/{{ $model->slug }}/edit" class="btn btn-sm btn-warning"><i class="bi bi-pen"></i></a>
<a href="/mahasiswa/{{ $model->slug }}" class="btn btn-sm btn-primary"><i class="bi bi-eye"></i></a>

<form action="/mahasiswa/{{ $model->slug }}" class="d-inline" method="post">
    @method('put')
    @csrf
    <button name="status" value="checked" class="btn btn-sm btn-{{ $model->status > 0 ? 'danger' : 'success' }}" ><i class="{{ $model->status > 0 ? 'bi bi-x-circle' : 'bi bi-check-circle' }}"></i></button>
</form>