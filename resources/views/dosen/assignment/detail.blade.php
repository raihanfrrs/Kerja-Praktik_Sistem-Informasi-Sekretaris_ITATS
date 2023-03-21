@extends('layouts.main')

@section('section')
<div class="col-md-3">
    <div class="card">
        <div class="card-body">
    
          <h5 class="card-title">Detail <span>| Mahasiswa</span></h5>
    
            <div class="profile-card pt-2 d-flex flex-column align-items-center">
                    <img src="{{ asset('/') }}assets/img/profile-img.jpg" class="img-fluid rounded">
                    <h2 class="mt-3 card-title text-center fs-4">{{ $request->mahasiswa->name }}</h2>
            </div>

            <div class="profile-card">
                <div class="row mb-2">
                    <div class="col-lg-12 col-md-12 text-lowercase text-center fw-bold">{{ $request->mahasiswa->email }}</div>
                </div>
        
                <div class="row">
                    <div class="col-lg-12 col-md-12 text-center fw-bold">{{ $request->mahasiswa->phone }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-9">
    <div class="card">
        <div class="card-body">
    
          <h5 class="card-title">Detail <span>| Assignment</span></h5>
    
          <form action="/assignment/{{ $request->id }}" method="post">
            @csrf
            @foreach ($detail_requests as $detail_request)
              <div class="row py-3">
                <div class="col-5">
                    <span class="fw-bold fs-4 text-capitalize">{{ $detail_request->name }}</span>
                    <p class="text-muted text-capitalize">{{ $detail_request->jenis }}</p>
                </div>
                <div class="col-7">
                    <input type="file" name="file" id="file" class="file-{{ $detail_request->id }}" data-key="{{ $detail_request->id }}">
                </div>
              </div>
            @endforeach

            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Submit</button>
            </div>
          </form>
    
        </div>
    </div>
</div>
@endsection