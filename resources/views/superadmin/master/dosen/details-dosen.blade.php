@extends('layouts.main')

@section('section')
<div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Dosen <span>| Foto Profil</span></h5>
            <div class="d-flex flex-column align-items-center">
                @if ($dosen[0]->image)
                <img src="{{ asset('storage/'. $dosen[0]->image) }}" class="img-fluid rounded" alt="{{ $dosen[0]->name }}">
                @else
                    <img src="{{ asset('/') }}assets/img/profile-img.jpg" class="img-fluid rounded" alt="{{ $dosen[0]->name }}">
                @endif
            </div>
        </div>
    </div>
</div>

<div class="col-md-8">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Dosen <span>| Rincian</span></h5>
    
            <div class="d-grid gap-3">
                <div class="row">
                    <div class="col-lg-3 col-md-4 label text-muted">Nama Lengkap</div>
                    <div class="col-lg-9 col-md-8 text-capitalize">{{ $dosen[0]->name }}</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 text-muted">NIP</div>
                    <div class="col-lg-9 col-md-8">{{ $dosen[0]->nip }}</div>
                </div>
    
                <div class="row">
                    <div class="col-lg-3 col-md-4 text-muted">Email</div>
                    <div class="col-lg-9 col-md-8 text-lowercase">{{ $dosen[0]->email }}</div>
                </div>
    
                <div class="row">
                    <div class="col-lg-3 col-md-4 text-muted">Nomor HP</div>
                    <div class="col-lg-9 col-md-8">{{ $dosen[0]->phone }}</div>
                </div>
    
                <div class="row">
                    <div class="col-lg-3 col-md-4 label text-muted">Tempat, Tanggal Lahir</div>
                    <div class="col-lg-9 col-md-8 text-capitalize">@if($dosen[0]->birthPlace && $dosen[0]->birthDate) {{ $dosen[0]->birthPlace }}, {{ $dosen[0]->birthDate }} @else - @endif</div>
                </div>
    
                <div class="row">
                    <div class="col-lg-3 col-md-4 label text-muted">Jenis Kelamin</div>
                    <div class="col-lg-9 col-md-8">@if($dosen[0]->gender) {{ Str::ucfirst($dosen[0]->gender) }} @else - @endif</div>
                </div>
                
                <div class="row">
                    <div class="col-lg-3 col-md-4 label text-muted">Jabatan</div>
                    <div class="col-lg-9 col-md-8 text-capitalize">
                        @if($roles->count() > 1)
                        <ul class="mb-0 roles">
                            @foreach ($roles as $role)
                                <li>{{ $role->role->role }}</li>
                            @endforeach
                        </ul>
                        @elseif($roles->count() == 1)
                            {{ $roles[0]->role->role }}
                        @else 
                            - 
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label text-muted">Status</div>
                    <div class="col-lg-9 col-md-8 text-uppercase"><span class="badge bg-{{ $dosen[0]->status == 'active' ? 'success' : 'danger'}}">{{ $dosen[0]->status }}</span></div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label text-muted">Registrasi</div>
                    <div class="col-lg-9 col-md-8">{{ $created_at }}</div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label text-muted">Pembaharuan Terakhir</div>
                    <div class="col-lg-9 col-md-8">{{ $dosen[0]->updated_at->diffForHumans() }}</div>
                </div>
    
                @if ($dosen[0]->status == 'active')
                    <div class="text-center mt-2">
                        <button class="btn btn-danger" id="deactivate-btn" value="{{ $dosen[0]->slug }}" data-id="{{ $dosen[0]->user->level }}"><i class="bi bi-trash3"></i> Nonaktifkan</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection