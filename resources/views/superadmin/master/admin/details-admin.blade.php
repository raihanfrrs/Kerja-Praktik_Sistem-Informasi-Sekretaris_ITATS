@extends('layouts.main')

@section('section')
<div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Admin <span>| Foto Profil</span></h5>
            <div class="d-flex flex-column align-items-center">
                @if ($admin->image)
                <img src="{{ asset('storage/'. $admin->image) }}" class="img-fluid rounded" alt="{{ $admin->name }}">
                @else
                    <img src="{{ asset('/') }}assets/img/profile-img.jpg" class="img-fluid rounded" alt="{{ $admin->name }}">
                @endif
            </div>
        </div>
    </div>
</div>

<div class="col-md-8">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Admin <span>| Rincian</span></h5>
    
            <div class="d-grid gap-3">
                <div class="row">
                    <div class="col-lg-3 col-md-4 label text-muted">Nama Lengkap</div>
                    <div class="col-lg-9 col-md-8 text-capitalize">{{ $admin->name }}</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 text-muted">NIP</div>
                    <div class="col-lg-9 col-md-8">{{ $admin->nip }}</div>
                </div>
    
                <div class="row">
                    <div class="col-lg-3 col-md-4 text-muted">Email</div>
                    <div class="col-lg-9 col-md-8 text-lowercase">{{ $admin->email }}</div>
                </div>
    
                <div class="row">
                    <div class="col-lg-3 col-md-4 text-muted">Nomor HP</div>
                    <div class="col-lg-9 col-md-8">{{ $admin->phone }}</div>
                </div>
    
                <div class="row">
                    <div class="col-lg-3 col-md-4 label text-muted">Tempat, Tanggal Lahir</div>
                    <div class="col-lg-9 col-md-8 text-capitalize">@if($admin->birthPlace && $admin->birthDate) {{ $admin->birthPlace }}, {{ $admin->birthDate }} @else - @endif</div>
                </div>
    
                <div class="row">
                    <div class="col-lg-3 col-md-4 label text-muted">Jenis Kelamin</div>
                    <div class="col-lg-9 col-md-8">@if($admin->gender) {{ Str::ucfirst($admin->gender) }} @else - @endif</div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label text-muted">Status</div>
                    <div class="col-lg-9 col-md-8 text-uppercase"><span class="badge bg-{{ $admin->status == 'active' ? 'success' : 'danger'}}">{{ $admin->status }}</span></div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label text-muted">Registrasi</div>
                    <div class="col-lg-9 col-md-8">{{ $created_at }}</div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label text-muted">Pembaharuan Terakhir</div>
                    <div class="col-lg-9 col-md-8">{{ $admin->updated_at->diffForHumans() }}</div>
                </div>
    
                @if ($admin->status == 'active')
                    <div class="text-center mt-2">
                        <button class="btn btn-danger" id="deactivate-btn" value="{{ $admin->slug }}" data-id="{{ $admin->user->level }}"><i class="bi bi-trash3"></i> Nonaktifkan</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection