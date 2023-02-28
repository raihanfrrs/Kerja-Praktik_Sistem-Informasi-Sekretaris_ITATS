@if ($model->status === 'finished')
    <span class="badge bg-success text-capitalize"><i class="bi bi-check-circle me-1"></i> {{ $model->status }}</span>
@else
    <span class="badge bg-danger text-capitalize"><i class="bi bi-exclamation-octagon me-1"></i> {{ $model->status }}</span>
@endif