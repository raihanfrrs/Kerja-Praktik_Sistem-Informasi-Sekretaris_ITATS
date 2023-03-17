<a href="/assignment/{{ $model->id }}" class="btn btn-sm btn-primary" title="Details"><i class="bi bi-eye"></i></a>
<form action="/history/{{ $model->id }}" method="post" class="d-inline" id="form-delete-history">
    @csrf
    @method('delete')
    <button class="btn btn-sm btn-danger" title="Delete" id="delete-history-btn"><i class="bi bi-trash3"></i></a>
</form>