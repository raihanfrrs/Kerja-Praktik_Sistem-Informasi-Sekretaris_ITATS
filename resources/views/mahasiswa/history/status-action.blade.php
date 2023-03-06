@if ($model->status === 'unfinished')
    <span class="badge bg-secondary text-capitalize"><i class="bi bi-collection me-1"></i> pending</span>
@elseif ($model->status === 'processed')
    <span class="badge bg-primary text-capitalize"><i class="bi bi-calendar-heart"></i> {{ $model->status }}</span>
@elseif ($model->status === 'finished')
    <span class="badge bg-success text-capitalize"><i class="bi bi-calendar-check"></i> {{ $model->status }}</span>
@elseif ($model->status === 'canceled' || $model->status === 'rejected')
    <span class="badge bg-danger text-capitalize"><i class="bi bi-calendar-x"></i> {{ $model->status }}</span>
@endif