
@if ($datas->count() == 0)
    <div class="alert alert-warning" role="alert">
        Belum ada dosen yang menunggu untuk disiarkan!
    </div>
@else
    <div class="news">
      @foreach ($datas as $data)
        <div class="post-item clearfix">
          @if ($data->dosen->image)
            <img src="{{ asset('storage/'. $data->dosen->image) }}" alt="">
          @else
            <img src="{{ asset('/') }}assets/img/profile-img.jpg" alt="">
          @endif
          <h3><a href="#">{{ $data->dosen->name }}</a></h3>
          <p>{{ $data->dosen->nip }}</p>
        </div>
      @endforeach
    </div>
@endif