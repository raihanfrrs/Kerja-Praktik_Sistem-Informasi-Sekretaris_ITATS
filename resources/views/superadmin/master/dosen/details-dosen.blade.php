@extends('layouts.main')

@section('section')
<div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Dosen <span>| Image</span></h5>
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
            <h5 class="card-title">Dosen <span>| Details</span></h5>
    
            <div class="d-grid gap-3">
                <div class="row">
                    <div class="col-lg-3 col-md-4 label text-muted">Full Name</div>
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
                    <div class="col-lg-3 col-md-4 text-muted">Phone</div>
                    <div class="col-lg-9 col-md-8">{{ $dosen[0]->phone }}</div>
                </div>
    
                <div class="row">
                    <div class="col-lg-3 col-md-4 label text-muted">Place, Date of Birth</div>
                    <div class="col-lg-9 col-md-8 text-capitalize">@if($dosen[0]->birthPlace && $dosen[0]->birthDate) {{ $dosen[0]->birthPlace }}, {{ $dosen[0]->birthDate }} @else - @endif</div>
                </div>
    
                <div class="row">
                    <div class="col-lg-3 col-md-4 label text-muted">Gender</div>
                    <div class="col-lg-9 col-md-8">@if($dosen[0]->gender) {{ Str::ucfirst($dosen[0]->gender) }} @else - @endif</div>
                </div>
                
                <div class="row">
                    <div class="col-lg-3 col-md-4 label text-muted">Role</div>
                    <div class="col-lg-9 col-md-8">
    
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label text-muted">Created At</div>
                    <div class="col-lg-9 col-md-8">{{ $created_at }}</div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label text-muted">Last Updated</div>
                    <div class="col-lg-9 col-md-8">{{ $dosen[0]->updated_at->diffForHumans() }}</div>
                </div>
    
                <div class="text-center mt-5">
                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash3"></i> Delete</button>
                    <a href="{{ url('/dosen') }}" class="btn btn-warning"><i class="bi bi-arrow-bar-left"></i> Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection