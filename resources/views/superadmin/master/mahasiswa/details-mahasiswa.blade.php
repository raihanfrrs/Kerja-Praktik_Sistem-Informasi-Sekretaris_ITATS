@extends('layouts.main')

@section('section')
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
                <div class="col-lg-9 col-md-8">{{ $mahasiswa[0]->email }}</div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-4 text-muted">Phone</div>
                <div class="col-lg-9 col-md-8">{{ $mahasiswa[0]->phone }}</div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-4 label text-muted">Place, Date of Birth</div>
                <div class="col-lg-9 col-md-8">@if($mahasiswa[0]->birthPlace && $mahasiswa[0]->birthDate) {{ $mahasiswa[0]->birthPlace }}, {{ $mahasiswa[0]->birthDate }} @else - @endif</div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-4 label text-muted">Gender</div>
                <div class="col-lg-9 col-md-8">@if($mahasiswa[0]->gender) {{ $mahasiswa[0]->gender }} @else - @endif</div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-4 label text-muted">Status</div>
                <div class="col-lg-9 col-md-8"><span class="badge bg-{{ $mahasiswa[0]->status > 0 ? 'success' : 'danger'}}">{{ $mahasiswa[0]->status > 0 ? 'approved' : 'disapprove'}}</span></div>
            </div>
        </div>
</div>
@endsection