@extends('layouts.main')

@section('section')
@foreach ($dosen as $detail)
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Dosen <span>| Details</span></h5>

        <div class="d-grid gap-3">
            <div class="row">
                <div class="col-lg-3 col-md-4 label text-muted">Full Name</div>
                <div class="col-lg-9 col-md-8">{{ $detail->name }}</div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 text-muted">NIP</div>
                <div class="col-lg-9 col-md-8">{{ $detail->nip }}</div>
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
                <div class="col-lg-3 col-md-4 label text-muted">Role</div>
                <div class="col-lg-9 col-md-8">
                    @foreach ($roles as $item)
                        {{ implode($item->role->role, ',') }}
                    @endforeach
                </div>
            </div>

            <h5 class="card-title"><p class="text-end"><span>Updated {{ $detail->updated_at->diffForHumans(); }}</span></p></h5>
          </div>
</div>
@endforeach
@endsection