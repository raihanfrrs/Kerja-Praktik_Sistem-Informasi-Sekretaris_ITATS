@extends('layouts.main')

@section('section')
@include('partials.logo')

<div class="card mb-3">

    <div class="card-body">

    <div class="pt-4 pb-2">
        <h5 class="card-title text-center pb-0 fs-4">Buat Akun</h5>
        <p class="text-center small">Masukkan Data Diri Anda Yang Diperlukan Sistem</p>
    </div>

    <form class="row g-3 needs-validation" method="post" action="register">
        @csrf
        <div class="col-12">
        <label for="yourName" class="form-label">Nama Lengkap</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="yourName" value="{{ old('name') }}" autocomplete="off" required>
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-12">
        <label for="yourNpm" class="form-label">NPM</label>
        <input type="text" name="npm" class="form-control @error('npm') is-invalid @enderror" id="yourNpm" value="{{ old('npm') }}" autocomplete="off" required>
        @error('npm') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-12">
        <label for="yourEmail" class="form-label">Email</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="yourEmail" value="{{ old('email') }}" autocomplete="off" required>
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-12">
        <label for="yourPhone" class="form-label">Nomor HP</label>
        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="yourPhone" value="{{ old('phone') }}" autocomplete="off" required>
        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-12">
        <label for="yourUsername" class="form-label">Username</label>
        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="yourUsername" value="{{ old('username') }}" autocomplete="off" required>
        @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-12">
        <label for="yourPassword" class="form-label">Kata Sandi</label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="yourPassword" autocomplete="off" required>
        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-12">
        <button class="btn btn-primary w-100" type="submit">Buat Akun</button>
        </div>
        <div class="col-12">
        <p class="small mb-0 text-center">Sudah Punya Akun? <a href="{{ url('login') }}">Masuk</a></p>
        </div>
    </form>

    </div>
</div>
@endsection