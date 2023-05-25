@if (count($requests) == 0)
    <div class="alert alert-warning" role="alert">
        Belum ada permintaan baru!
    </div>
@else
    @foreach ($requests as $request)
        <div class="post-item clearfix mb-3">
            @if ($request->user->level === 'mahasiswa')
                @if ($request->user->mahasiswa->image)
                    <img src="{{ asset('storage/'. $request->user->mahasiswa->image) }}" class="img-thumbnail" alt="">
                @else 
                    <img src="{{ asset('/') }}assets/img/profile-img.jpg" class="img-thumbnail" alt="">
                @endif
            @else
                @if ($request->user->dosen->image)
                    <img src="{{ asset('storage/'. $request->user->dosen->image) }}" class="img-thumbnail" alt="">
                @else 
                    <img src="{{ asset('/') }}assets/img/profile-img.jpg" class="img-thumbnail" alt="">
                @endif
            @endif
            <h4><a href="#">{{ $request->user->level === 'mahasiswa' ? $request->user->mahasiswa->name : $request->user->dosen->name }}</a></h4>
            <p>Melakukan request pada {{ $request->created_at->diffForHumans() }}</p>
        </div>
        @endforeach
@endif