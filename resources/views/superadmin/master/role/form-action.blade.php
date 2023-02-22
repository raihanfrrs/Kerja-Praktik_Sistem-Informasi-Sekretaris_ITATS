<a href="/role/{{ $model->slug }}/edit" class="btn btn-sm btn-warning" title="Edit"><i class="bi bi-pen"></i></a>
<button class="btn btn-sm btn-primary" title="Details" id="detail-role-button" value="{{ $model->slug }}"><i class="bi bi-eye"></i></button>
<form action="/role/{{ $model->slug }}" method="post" class='d-inline'>
    @csrf
    @method('delete')
    <button type="submit" class="btn btn-sm btn-danger" title="Delete"><i class="bi bi-trash3"></i></button>
</form>