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
                    <div class="col-lg-9 col-md-8"><span class="badge bg-{{ $mahasiswa[0]->status > 0 ? 'success' : 'danger'}}">{{ $mahasiswa[0]->status > 0 ? 'APPROVED' : 'DISAPPROVE'}}</span></div>
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
    
            <div class="text-center mt-5">
                <button type="submit" class="btn btn-danger"><i class="bi bi-trash3"></i> Delete</button>
                <a href="{{ url('/mahasiswa') }}" class="btn btn-warning"><i class="bi bi-arrow-bar-left"></i> Back</a>
            </div>
        </div>
    </div>
</div>
@endsection