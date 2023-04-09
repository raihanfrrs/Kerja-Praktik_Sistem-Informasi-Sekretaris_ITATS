@if ($model->status === 'finished')
    <a href="/acception/{{ $model->id }}" class="btn btn-sm btn-secondary" title="Details"><i class="bi bi-eye"></i></a>
@else
    <a href="#" class="btn btn-sm btn-secondary disabled" title="Details"><i class="bi bi-eye"></i></a>
@endif