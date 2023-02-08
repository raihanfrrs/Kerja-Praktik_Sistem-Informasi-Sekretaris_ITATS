@extends('layouts.main')

@section('section')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Dosen <span>| Details</span></h5>

        <div class="d-grid gap-3">
            <div class="row">
                <div class="col-lg-3 col-md-4 label text-muted">Full Name</div>
                <div class="col-lg-9 col-md-8">{{ $dosen[0]->name }}</div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 text-muted">NIP</div>
                <div class="col-lg-9 col-md-8">{{ $dosen[0]->nip }}</div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-4 text-muted">Email</div>
                <div class="col-lg-9 col-md-8">{{ $dosen[0]->email }}</div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-4 text-muted">Phone</div>
                <div class="col-lg-9 col-md-8">{{ $dosen[0]->phone }}</div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-4 label text-muted">Place, Date of Birth</div>
                <div class="col-lg-9 col-md-8">@if($dosen[0]->birthPlace && $dosen[0]->birthDate) {{ $dosen[0]->birthPlace }}, {{ $dosen[0]->birthDate }} @else - @endif</div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-4 label text-muted">Gender</div>
                <div class="col-lg-9 col-md-8">@if($dosen[0]->gender) {{ $dosen[0]->gender }} @else - @endif</div>
            </div>
            
            <div class="row">
                <div class="col-lg-3 col-md-4 label text-muted">Role</div>
                <div class="col-lg-9 col-md-8">

                </div>
            </div>

            <h5 class="card-title"><p class="text-end"><span>Updated {{ $dosen[0]->updated_at->diffForHumans(); }}</span></p></h5>
          </div>
    </div>
</div>
@endsection