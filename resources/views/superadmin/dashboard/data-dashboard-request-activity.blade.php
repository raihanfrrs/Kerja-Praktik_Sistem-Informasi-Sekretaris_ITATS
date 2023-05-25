@if ($requests->count() == 0)
    <div class="alert alert-warning" role="alert">
        Belum ada aktifitas terbaru!
    </div>
@else
    @foreach ($requests as $request)
        <div class="post-item clearfix">
            @if ($request->user->level === 'mahasiswa')
                @if ($request->user->mahasiswa->image)
                    <img src="{{ asset('storage/'. $request->user->mahasiswa->image) }}" class="img-thumbnail" alt="{{ $request->user->mahasiswa->image }}">
                @else
                    <img src="{{ asset('/') }}assets/img/profile-img.jpg" class="img-thumbnail" alt="{{ $request->user->mahasiswa->image }}">
                @endif
                <h4><a href="/mahasiswa/{{ $request->user->mahasiswa->slug }}">{{ $request->user->mahasiswa->name }}</a></h4>
            @else
                @if ($request->user->dosen->image)
                    <img src="{{ asset('storage/'. $request->user->dosen->image) }}" class="img-thumbnail" alt="{{ $request->user->dosen->image }}">
                @else
                    <img src="{{ asset('/') }}assets/img/profile-img.jpg" class="img-thumbnail" alt="{{ $request->user->dosen->image }}">
                @endif
                <h4><a href="/dosen/{{ $request->user->dosen->slug }}">{{ $request->user->dosen->name }}</a></h4>
            @endif
            <p>Requesting {{ $request->detail_request->count() }} Surat.
                <br>
                <span>{{ $request->created_at->diffForHumans() }}.</span>
            </p>
        </div>
    @endforeach
@endif