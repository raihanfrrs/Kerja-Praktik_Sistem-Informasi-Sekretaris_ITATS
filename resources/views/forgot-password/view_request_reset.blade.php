@extends('layouts.main')

@section('section')
@include('partials.logo')


<div class="card mb-3">

  <div class="card-body">

    <div class="pt-4 pb-2">
      <h5 class="card-title text-center pb-0 fs-4">Verification</h5>
    </div>

    <form class="row g-3 needs-validation" action="{{ url('check-otp') }}" method="post">
      @csrf
      <div class="col-12">
        <label for="yourEmail" class="form-label">Email</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="yourEmail" value="{{ old('email') }}" autocomplete="off" required>
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="col-12">
        <label for="yourOTP" class="form-label">OTP CODE</label>
        <div class="input-group mb-3">
          <input type="number" name="otp" id="yourOTP" class="form-control @error('otp') is-invalid @enderror" placeholder="Enter 6 Digits OTP" aria-label="Recipient's username" aria-describedby="button-addon2" required>
          <input class="btn btn-outline-secondary" type="button" value="GET OTP" id="btn-get-otp">
        </div>
        @error('otp')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="col-12">
        <input class="btn btn-primary w-100" id="btn-renew-pass" value="Submit" type="submit">
      </div>
      <div class="col-12">
        <p class="small mb-0 text-center"><a href="/login">Already Remember?</a></p>
      </div>
    </form>

  </div>
</div>
@endsection