@foreach ($requests as $request)
<div class="post-item clearfix">
    @if ($request->mahasiswa->image)
        <img src="{{ asset('storage/'. $request->mahasiswa->image) }}" class="img-thumbnail" alt="">
    @else 
        <img src="{{ asset('/') }}assets/img/profile-img.jpg" class="img-thumbnail" alt="">
    @endif
    <h4><a href="#">{{ $request->mahasiswa->name }}</a></h4>
    <p>Melakukan request pada {{ $request->created_at->diffForHumans() }}</p>
</div>
@endforeach