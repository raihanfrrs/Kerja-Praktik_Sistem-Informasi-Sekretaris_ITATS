@if ($model->status === 'unfinished')
    <span class="badge bg-warning text-capitalize"><i class="bi bi-clipboard"></i> Pending</span>
@elseif ($model->status === 'processed')
    <span class="badge bg-primary text-capitalize"><i class="bi bi-clipboard-data"></i> Proses</span>
@elseif ($model->status === 'finished')
    <span class="badge bg-success text-capitalize"><i class="bi bi-clipboard-check"></i> Selesai</span>
@elseif ($model->status === 'canceled' || $model->status === 'rejected')
    <span class="badge bg-danger text-capitalize"><i class="bi bi-clipboard-x"></i> 
        @if ($model->status === 'canceled')
            Dibatalkan
        @elseif ($model->status === 'rejected')
            Ditolak
        @endif
    </span>
@endif