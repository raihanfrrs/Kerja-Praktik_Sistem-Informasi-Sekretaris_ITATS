@if ($model->status == 'disapprove')
    <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> TIDAK DISETUJUI</span>
@else
    <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> DISETUJUI</span>
@endif