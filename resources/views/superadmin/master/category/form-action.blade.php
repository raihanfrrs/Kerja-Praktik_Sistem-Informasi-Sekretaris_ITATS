<a href="/category/{{ $model->slug }}/edit" class="btn btn-sm btn-warning" title="Ubah"><i class="bi bi-pen"></i></a>
<form action="/category/{{ $model->slug }}" method="post" class="d-inline">
    @csrf
    @method('delete')
    <button type="submit" class="btn btn-sm btn-danger" title="Hapus"><i class="bi bi-trash3"></i></button>
</form>