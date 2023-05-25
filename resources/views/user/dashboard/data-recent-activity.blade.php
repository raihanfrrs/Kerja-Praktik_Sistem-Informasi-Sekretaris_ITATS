@if (count($activities) == 0)
  <div class="alert alert-warning" role="alert">
    Belum ada aktifitas terbaru!
  </div>
@endif
@foreach ($activities as $activity)
  <div class="activity-item d-flex">
    <div class="activite-label">{{ $activity->updated_at->diffForHumans() }}</div>
    <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
    <div class="activity-content">
      Melakukan <a href="#" class="fw-bold text-dark">Permintaan {{ $activity->detail_request->count() }} Surat</a> Kepada Dosen.
    </div>
  </div>    
@endforeach