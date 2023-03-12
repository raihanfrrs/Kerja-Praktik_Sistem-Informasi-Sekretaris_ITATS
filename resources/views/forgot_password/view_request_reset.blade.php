@extends('layouts.main')

@section('section')
@include('partials.logo')


<div class="card mb-3">

  <div class="card-body">

    <div class="pt-4 pb-2">
      @include('partials.flash')
      <h5 class="card-title text-center pb-0 fs-4">Reset Password</h5>
    </div>

    <form class="row g-3 needs-validation" id="form-renew-password" action="{{ url('/renew-password') }}" method="post">
      <input type="hidden" name="_token" id="csfr" value="{{ csrf_token() }}">
      <div class="col-12">
        <label for="yourEmail" class="form-label">Email</label>
        <input type="text" name="Email" class="form-control @error('Email') is-invalid @enderror" id="yourEmail" value="{{ old('Email') }}" autocomplete="off" required>
        @error('Email')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="col-12">
        <label for="yourOTP" class="form-label">CODE OTP</label>
        <div class="input-group mb-3">
          <input type="number" name="otp" id="yourOTP" class="form-control" placeholder="Masukan 6 digit otp" maxlength="6" minlength="6" aria-label="Recipient's username" aria-describedby="button-addon2"@error('otp') is-invalid @enderror>
          <input class="btn btn-outline-secondary" type="button" value="GET OTP" id="btn-get-otp">
        </div>
        @error('otp')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <input type="hidden" id="user-id-input" value="none" name="user_id">
      
      <div class="col-12">
        <label for="password" class="form-label">New Password</label>
        <div class="input-group mb-3">
          <input type="password" id="new-pass-input" name="renew_password" class="form-control" placeholder="Masukan minimal 6 digit password"  minlength="6" @error('password') is-invalid @enderror>
          <button type="button" class="btn btn-outline-secondary" id="btn-show-password"><i class='bi bi-eye-fill'></i></button>
        </div>
        @error('otp')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="col-12">
        <input class="btn btn-primary w-100" id="btn-renew-pass" value="Submit" type="button">
      </div>
      <div class="col-12">
        <p class="small mb-0 text-center">sudah ingat ?<a href="login">Login</a></p>
      </div>
    </form>

  </div>
</div>
@endsection