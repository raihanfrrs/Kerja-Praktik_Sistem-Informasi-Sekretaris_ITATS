@extends('layouts.main')

@section('section')
<div class="col-md-7">
    <form action="/category" method="post">
    @csrf
    <div class="card">
        <div class="card-body">
        <h5 class="card-title">Surat <span>| Tambah</span></h5>

            <div class="row mb-3">
                <label for="jenis" class="col-sm-2 col-form-label">Jenis Surat</label>
                <div class="col-sm-10">
                <input type="text" class="form-control @error('jenis') is-invalid @enderror text-capitalize" id="jenis" name="jenis" required value="{{ old('jenis') }}" autocomplete="off" placeholder="Jenis Surat">
                @error('jenis') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                </div>
            </div>
    
            <div class="text-center mt-5">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Kirim</button>
            </div>
        </div>
    </div>
</div>
@endsection