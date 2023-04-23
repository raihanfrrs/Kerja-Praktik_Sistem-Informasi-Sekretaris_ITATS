@extends('layouts.main')

@section('section')
<div class="col-md-7">
    <form action="/surat" method="post">
    @csrf
    <div class="card">
        <div class="card-body">
        <h5 class="card-title">Surat <span>| Tambah</span></h5>

            <div class="row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Surat</label>
                <div class="col-sm-10">
                <input type="text" class="form-control @error('name') is-invalid @enderror text-capitalize" id="name" name="name" required value="{{ old('name') }}" autocomplete="off" placeholder="Surat">
                @error('name') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="jenis_surat" class="col-sm-2 col-form-label">Jenis Surat</label>
                <div class="col-sm-10">
                <select class="form-select @error('jenis_surat_id') is-invalid @enderror" name="jenis_surat_id" id="jenis_surat" required>
                    @foreach ($jenis_surats as $jenis_surat)
                    @if (old('jenis_surat_id') == $jenis_surat->id)
                        <option value="{{ $jenis_surat->id }}" selected>{{ $jenis_surat->jenis }}</option>
                    @else
                        <option value="{{ $jenis_surat->id }}">{{ $jenis_surat->jenis }}</option>
                    @endif
                    @endforeach
                </select>
                @error('jenis_surat_id') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="description" class="col-sm-2 col-form-label">Deskripsi</label>
                <div class="col-sm-10">
                    <input id="description" type="hidden" name="description" value="{{ old('description') }}">
                    <trix-editor input="description"></trix-editor>
                    @error('description')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
    
            <div class="text-center mt-5">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Kirim</button>
            </div>
        </div>
    </div>
</div>
@endsection