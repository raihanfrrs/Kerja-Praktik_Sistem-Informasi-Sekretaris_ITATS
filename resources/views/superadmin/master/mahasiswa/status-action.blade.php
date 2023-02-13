@if ($model->status == 'disapprove')
    <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> DISAPPROVE</span>
@else
    <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> APPROVED</span>
@endif