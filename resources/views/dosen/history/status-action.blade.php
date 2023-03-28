@php
    $counter = 0;
    $done = 0;
    $rejected = 0;
@endphp
@foreach ($model->detail_request as $item)
    @if ($item->dosen_id == auth()->user()->dosen->id)
        @php $counter++ @endphp
    @endif

    @if ($item->status === 'done' && $item->dosen_id == auth()->user()->dosen->id)
        @php $done++ @endphp
    @endif

    @if ($item->status === 'rejected' && $item->dosen_id == auth()->user()->dosen->id)
        @php $rejected++ @endphp
    @endif
@endforeach

@if ($done === $counter)
    <span class="badge bg-success text-capitalize"><i class="bi bi-clipboard-check"></i> Finished</span>
@elseif ($rejected === $counter)
    <span class="badge bg-danger text-capitalize"><i class="bi bi-clipboard-x"></i> Rejected</span>
@else
    <span class="badge bg-primary text-capitalize"><i class="bi bi-clipboard-data"></i> Processed</span>
@endif