@extends('layouts.main')

@section('section')
<div class="col-md-7">
    <form action="/role/{{ $role->slug }}" method="post">
    @csrf
    @method('put')
    <div class="card">
        <div class="card-body">
        <h5 class="card-title">Role <span>| Edit</span></h5>

            <div class="row mb-3">
                <label for="role" class="col-sm-2 col-form-label">Role</label>
                <div class="col-sm-10">
                <input type="text" class="form-control @error('role') is-invalid @enderror text-capitalize" id="role" name="role" required value="{{ old('role', $role->role) }}" autocomplete="off">
                @error('role') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                </div>
            </div>

            <div class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">Jenis Surat</legend>
                <div class="col-sm-10">
                    @foreach ($jenis_surats as $jenis_surat)
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="{{ $jenis_surat->jenis }}" name="jenis_surat[]" value="{{ $jenis_surat->jenis }}" {{ in_array($jenis_surat->jenis, $job) ? ' checked' : '' }}>
                        <label class="form-check-label text-capitalize" for="{{ $jenis_surat->jenis }}">{{ $jenis_surat->jenis }}</label>
                    </div>
                    @endforeach
                    @if($errors->any())
                    @php
                        $error = $errors->getBags()['default']->get('jenis_surat');
                    @endphp
                        <span class="text-danger">{{$error[0]}}</span>
                    @endif
                </div>
            </div>
    
            <div class="text-center mt-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Submit</button>
            </div>
        </div>
    </div>
</div>
@endsection