@if ($requests->count() == 0)
    <div class="alert alert-danger" role="alert">
        No activity requests are currently in active!
    </div>
@else
    @foreach ($requests as $request)
    <div class="post-item clearfix">
        @if ($request->mahasiswa->image)
                <img src="{{ asset('storage/'. $request->mahasiswa->image) }}" class="img-fluid rounded" alt="{{ $request->mahasiswa->image }}">
            @else
                <img src="{{ asset('/') }}assets/img/profile-img.jpg" alt="{{ $request->mahasiswa->image }}">
            @endif
        <h4><a href="/mahasiswa/{{ $request->mahasiswa->slug }}">{{ $request->mahasiswa->name }}</a></h4>
        <p>Requesting {{ $request->detail_request->count() }} Surat.
            <br>
            <span>{{ $request->created_at->diffForHumans() }}.</span>
        </p>
    </div>
    <hr>
    @endforeach
@endif