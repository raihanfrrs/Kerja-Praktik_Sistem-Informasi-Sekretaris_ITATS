@extends('layouts.main')

@section('section')
<div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Mahasiswa <span>| Image</span></h5>
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
            <h5 class="card-title">Mahasiswa <span>| Details</span></h5>
    
            <div class="d-grid gap-3">
                <div class="row">
                    <div class="col-lg-3 col-md-4 label text-muted">Full Name</div>
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
                    <div class="col-lg-3 col-md-4 text-muted">Phone</div>
                    <div class="col-lg-9 col-md-8">{{ $mahasiswa[0]->phone }}</div>
                </div>
    
                <div class="row">
                    <div class="col-lg-3 col-md-4 label text-muted">Place, Date of Birth</div>
                    <div class="col-lg-9 col-md-8 text-capitalize">@if($mahasiswa[0]->birthPlace && $mahasiswa[0]->birthDate) {{ $mahasiswa[0]->birthPlace }}, {{ $mahasiswa[0]->birthDate }} @else - @endif</div>
                </div>
    
                <div class="row">
                    <div class="col-lg-3 col-md-4 label text-muted">Gender</div>
                    <div class="col-lg-9 col-md-8">@if($mahasiswa[0]->gender) {{ Str::ucfirst($mahasiswa[0]->gender) }} @else - @endif</div>
                </div>
    
                <div class="row">
                    <div class="col-lg-3 col-md-4 label text-muted">Status</div>
                    <div class="col-lg-9 col-md-8 text-uppercase"><span class="badge bg-{{ $mahasiswa[0]->status == 'approved' ? 'success' : 'danger'}}">{{ $mahasiswa[0]->status }}</span></div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label text-muted">Created At</div>
                    <div class="col-lg-9 col-md-8">{{ $created_at }}</div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label text-muted">Last Updated</div>
                    <div class="col-lg-9 col-md-8">{{ $mahasiswa[0]->updated_at->diffForHumans() }}</div>
                </div>
            </div>
    
            @if ($mahasiswa[0]->status == 'disapprove' || $mahasiswa[0]->status == 'approved')
                <div class="text-center mt-2">
                    <button class="btn btn-danger" id="deactivate-btn" value="{{ $mahasiswa[0]->slug }}" data-id="{{ $mahasiswa[0]->user->level }}"><i class="bi bi-trash3"></i> Deactivate</button>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection