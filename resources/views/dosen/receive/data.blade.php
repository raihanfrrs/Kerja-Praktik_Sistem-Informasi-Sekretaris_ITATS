@foreach ($receives as $receive)
<div class="col-md-3">
    <div class="card">
        <div class="card-body">
          <h5 class="card-title">{{ $receive->mahasiswa->name }}</h5>
          <h6 class="card-subtitle mb-2 text-muted">Last Updated {{\Carbon\Carbon::parse($receive->date)->diffForHumans() }}.</h6>
          <p class="card-text">Have {{ $receive->amount }} surat request.</p>
          <p class="card-text"><a href="#" class="btn btn-primary">Button</a></p>
          <a href="#" class="card-link">Card link</a>
          <a href="#" class="card-link">Another link</a>
        </div>
    </div>
</div>
@endforeach