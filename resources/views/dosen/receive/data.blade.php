@foreach ($receives as $receive)
<div class="col-md-3">
    <div class="card">
        <div class="card-body">
          <h5 class="card-title">{{ $receive->mahasiswa->name }}</h5>
          <h6 class="card-subtitle mb-2 text-muted">{{ $receive->amount }}</h6>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          <p class="card-text"><a href="#" class="btn btn-primary">Button</a></p>
          <a href="#" class="card-link">Card link</a>
          <a href="#" class="card-link">Another link</a>
        </div>
    </div>
</div>
@endforeach