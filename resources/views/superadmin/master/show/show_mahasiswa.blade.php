@extends('layouts.main')

@section('section')
@foreach ($mahasiswa as $detail)
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Mahasiswa <span>| Details</span></h5>

        <div class="d-grid gap-3">
            <div class="row">
                <div class="col-lg-3 col-md-4 label text-muted">Full Name</div>
                <div class="col-lg-9 col-md-8">{{ $detail->name }}</div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 text-muted">NPM</div>
                <div class="col-lg-9 col-md-8">{{ $detail->npm }}</div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-4 text-muted">Email</div>
                <div class="col-lg-9 col-md-8">{{ $detail->email }}</div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-4 text-muted">Phone</div>
                <div class="col-lg-9 col-md-8">{{ $detail->phone }}</div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-4 label text-muted">Place, Date of Birth</div>
                <div class="col-lg-9 col-md-8">@if($detail->birthPlace && $detail->birthDate) {{ $detail->birthPlace }}, {{ $detail->birthDate }} @else - @endif</div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-4 label text-muted">Gender</div>
                <div class="col-lg-9 col-md-8">@if($detail->gender) {{ $detail->gender }} @else - @endif</div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-4 label text-muted">Status</div>
                <div class="col-lg-9 col-md-8"><span class="badge bg-{{ $detail->status > 0 ? 'success' : 'danger'}}">{{ $detail->status > 0 ? 'approved' : 'disapprove'}}</span></div>
            </div>
          </div>
</div>
@endforeach
@endsection