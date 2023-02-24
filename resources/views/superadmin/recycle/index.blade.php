@extends('layouts.main')

@section('section')
    <div class="card mx-2">
        <div class="card-body @if(Session::get('deactivate') == 0) p-0 @endif">
            @if (Session::get('deactivate') == 0)
                <div class="alert alert-primary m-3" role="alert">
                    <span class="fw-bold">Sorry,</span> You don't have one recycle data!
                </div>
            @endif

            @if ($mahasiswas->count() != 0)
            <h5 class="card-title">Mahasiswa <span>| List</span></h5>
            @endif

            @foreach ($mahasiswas as $mahasiswa)
                <div class="single-notification">
                    <div class="notification">
                        <div class="image bg-primary">
                            <span>{{ mb_substr($mahasiswa->name, 0, 1) }}</span>
                        </div>
                        <a href="/mahasiswa/{{ $mahasiswa->slug }}" class="content">
                            <h5 class="fw-bold text-black">{{ Str::ucfirst($mahasiswa->name) }}</h5>
                            <p class="text-lowercase text-muted mb-1 fst-italic">{{ $mahasiswa->email }}</p>
                            <p class="text-muted">{{ $mahasiswa->phone }}</p>
                            <span class="fw-semibold text-muted">Moved in {{ $mahasiswa->updated_at->diffForHumans() }}</span>
                        </a>
                    </div>
                    <div class="action">
                        <form action="/recycle/{{ $mahasiswa->slug }}" method="post" id="delete-form-{{ $mahasiswa->slug }}">
                            @csrf
                            @method('delete')
                            <button type="submit" id="delete-btn" class="action-btn" value="{{ $mahasiswa->slug }}" title="Delete">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </form>
                        <form action="/recycle/{{ $mahasiswa->slug }}" method="post">
                            @csrf
                            @method('put')
                            <button type="submit" class="action-btn" title="Restore">
                                <i class="bi bi-arrow-clockwise"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <hr>
            @endforeach

            @if ($dosens->count() != 0)
            <h5 class="card-title">Dosen <span>| List</span></h5>
            @endif

            @foreach ($dosens as $dosen)
                <div class="single-notification">
                    <div class="notification">
                        <div class="image bg-warning">
                            <span>{{ mb_substr($dosen->name, 0, 1) }}</span>
                        </div>
                        <a href="/dosen/{{ $dosen->slug }}" class="content">
                            <h5 class="fw-bold text-black">{{ Str::ucfirst($dosen->name) }}</h5>
                            <p class="text-lowercase text-muted mb-1 fst-italic">{{ $dosen->email }}</p>
                            <p class="text-muted">{{ $dosen->phone }}</p>
                            <span class="fw-semibold text-muted">Moved in {{ $dosen->updated_at->diffForHumans() }}</span>
                        </a>
                    </div>
                    <div class="action">
                        <form action="/recycle/{{ $dosen->slug }}" method="post" id="delete-form-{{ $dosen->slug }}">
                            @csrf
                            @method('delete')
                            <button type="submit" id="delete-btn" class="action-btn" value="{{ $dosen->slug }}" title="Delete">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </form>
                        <form action="/recycle/{{ $dosen->slug }}" method="post">
                            @csrf
                            @method('put')
                            <button type="submit" class="action-btn" title="Restore">
                                <i class="bi bi-arrow-clockwise"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <hr>
            @endforeach

            @if ($jenis_surats->count() != 0)
            <h5 class="card-title">Jenis Surat <span>| List</span></h5>
            @endif

            @foreach ($jenis_surats as $jenis_surat)
                <div class="single-notification">
                    <div class="notification">
                        <div class="image bg-success">
                            <span>{{ mb_substr($jenis_surat->jenis, 0, 1) }}</span>
                        </div>
                        <a href="#" class="content">
                            <h5 class="fw-bold text-black">{{ Str::ucfirst($jenis_surat->jenis) }}</h5>
                            <span class="fw-semibold text-muted">Moved in {{ $jenis_surat->updated_at->diffForHumans() }}</span>
                        </a>
                    </div>
                    <div class="action">
                        <form action="/recycle/{{ $jenis_surat->slug }}" method="post" id="delete-form-{{ $jenis_surat->slug }}">
                            @csrf
                            @method('delete')
                            <button type="submit" id="delete-btn" class="action-btn" value="{{ $jenis_surat->slug }}" title="Delete">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </form>
                        <form action="/recycle/{{ $jenis_surat->slug }}" method="post">
                            @csrf
                            @method('put')
                            <button type="submit" class="action-btn" title="Restore">
                                <i class="bi bi-arrow-clockwise"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <hr>
            @endforeach

            @if ($roles->count() != 0)
            <h5 class="card-title">Role <span>| List</span></h5>
            @endif

            @foreach ($roles as $role)
                <div class="single-notification">
                    <div class="notification">
                        <div class="image bg-info">
                            <span>{{ mb_substr($role->role, 0, 1) }}</span>
                        </div>
                        <a href="#" class="content">
                            <h5 class="fw-bold text-black">{{ Str::ucfirst($role->role) }}</h5>
                            <span class="fw-semibold text-muted">Moved in {{ $role->updated_at->diffForHumans() }}</span>
                        </a>
                    </div>
                    <div class="action">
                        <form action="/recycle/{{ $role->slug }}" method="post" id="delete-form-{{ $role->slug }}">
                            @csrf
                            @method('delete')
                            <button type="submit" id="delete-btn" class="action-btn" value="{{ $role->slug }}" title="Delete">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </form>
                        <form action="/recycle/{{ $role->slug }}" method="post">
                            @csrf
                            @method('put')
                            <button type="submit" class="action-btn" title="Restore">
                                <i class="bi bi-arrow-clockwise"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <hr>
            @endforeach

        </div>
    </div>
@endsection