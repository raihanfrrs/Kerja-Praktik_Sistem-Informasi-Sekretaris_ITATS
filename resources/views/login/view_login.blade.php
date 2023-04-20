@extends('layouts.main')

@section('section')
@include('partials.logo')

<div class="card mb-3">

  <div class="card-body">

    <div class="pt-4 pb-2">
      @include('partials.flash')
      <h5 class="card-title text-center pb-0 fs-4">Identifikasikan Diri Anda</h5>
      <p class="text-center small">Isi Kolom Yang Diperlukan Dibawah Ini</p>
    </div>

    <form class="row g-3 needs-validation" action="{{ url('login/proses') }}" method="post">
      @csrf
      <div class="col-12">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" value="{{ old('username') }}" autocomplete="off">
        @error('username')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="col-12">
        <label for="password" class="form-label">Kata Sandi</label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" autocomplete="off">
        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="col-12">
        <button class="btn btn-primary w-100" type="submit">Masuk</button>
      </div>
      <div class="col-6">
        <p class="small mb-0 text-center"><a href="/register">Anda Mahasiswa & Tidak Punya Akun?</a></p>
      </div>
      <div class="col-6">
        <p class="small mb-0 text-center"><a href="/forgot-password">Lupa Kata Sandi?</a></p>
      </div>
    </form>

  </div>
</div>
@endsection