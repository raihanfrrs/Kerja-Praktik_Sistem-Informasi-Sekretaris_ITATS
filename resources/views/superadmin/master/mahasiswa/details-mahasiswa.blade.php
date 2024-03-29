@extends('layouts.main')

@section('section')
<div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Mahasiswa <span>| Foto Profil</span></h5>
            <div class="d-flex flex-column align-items-center">
                @if ($mahasiswa[0]->image)
                    <img src="{{ asset('storage/'. $mahasiswa[0]->image) }}" class="img-fluid rounded" alt="{{ $mahasiswa[0]->name }}">
                @else
                    <img src="{{ asset('/') }}assets/img/profile-img.jpg" class="img-fluid rounded" alt="{{ $mahasiswa[0]->name }}">
                @endif
            </div> 
        </div>
    </div>
</div>
<div class="col-md-8">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Mahasiswa <span>| Rincian</span></h5>
    
            <div class="d-grid gap-3">
                <div class="row">
                    <div class="col-lg-3 col-md-4 label text-muted">Nama Lengkap</div>
                    <div class="col-lg-9 col-md-8">{{ $mahasiswa[0]->name }}</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 text-muted">NPM</div>
                    <div class="col-lg-9 col-md-8">{{ $mahasiswa[0]->npm }}</div>
                </div>
    
                <div class="row">
                    <div class="col-lg-3 col-md-4 text-muted">Email</div>
                    <div class="col-lg-9 col-md-8 text-lowercase">{{ $mahasiswa[0]->email }}</div>
                </div>
    
                <div class="row">
                    <div class="col-lg-3 col-md-4 text-muted">Nomor HP</div>
                    <div class="col-lg-9 col-md-8">{{ $mahasiswa[0]->phone }}</div>
                </div>
    
                <div class="row">
                    <div class="col-lg-3 col-md-4 label text-muted">Tempat, Tanggal Lahir</div>
                    <div class="col-lg-9 col-md-8 text-capitalize">@if($mahasiswa[0]->birthPlace && $mahasiswa[0]->birthDate) {{ $mahasiswa[0]->birthPlace }}, {{ $mahasiswa[0]->birthDate }} @else - @endif</div>
                </div>
    
                <div class="row">
                    <div class="col-lg-3 col-md-4 label text-muted">Jenis Kelamin</div>
                    <div class="col-lg-9 col-md-8">
                        @if($mahasiswa[0]->gender) 
                            @if ($mahasiswa[0]->gender === 'male')
                                Laki=laki
                            @elseif ($mahasiswa[0]->gender === 'female')
                                Perempuan
                            @endif 
                        @else 
                            - 
                        @endif
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-lg-3 col-md-4 label text-muted">Status</div>
                    <div class="col-lg-9 col-md-8 text-uppercase"><span class="badge bg-{{ $mahasiswa[0]->status == 'approved' ? 'success' : 'danger'}}">{{ $mahasiswa[0]->status }}</span></div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label text-muted">Registrasi</div>
                    <div class="col-lg-9 col-md-8">{{ $created_at }}</div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label text-muted">Perbaharuan Terakhir</div>
                    <div class="col-lg-9 col-md-8">{{ $mahasiswa[0]->updated_at->diffForHumans() }}</div>
                </div>
            </div>
    
            @if ($mahasiswa[0]->status == 'disapprove' || $mahasiswa[0]->status == 'approved')
                <div class="text-center mt-2">
                    <button class="btn btn-danger" id="deactivate-btn" value="{{ $mahasiswa[0]->slug }}" data-id="{{ $mahasiswa[0]->user->level }}"><i class="bi bi-trash3"></i> Nonaktifkan</button>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection