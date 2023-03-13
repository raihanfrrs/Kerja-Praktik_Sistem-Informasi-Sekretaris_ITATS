@extends('layouts.main')

@section('section')
@include('partials.logo')


<div class="card mb-3">

  <div class="card-body">

    <div class="pt-4 pb-2">
      <h5 class="card-title text-center pb-0 fs-4">Reset Password</h5>
    </div>

    <form class="row g-3 needs-validation" id="form-renew-password" action="{{ url('renew-password') }}/{{ $user }}" method="post">
      @csrf
      
      <div class="col-12">
        <label for="password" class="form-label">New Password</label>
        <div class="input-group mb-3">
          <input type="password" id="new-pass-input" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukan minimal 6 digit password" required>
          <button type="button" class="btn btn-outline-secondary" id="btn-show-password"><i class='bi bi-eye-fill'></i></button>
        </div>
        @if ($errors->any())
          @foreach ($errors->all() as $error)
              <div>{{$error}}</div>
          @endforeach
        @endif
        @error('password')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="col-12">
        <input class="btn btn-primary w-100" id="btn-renew-pass" value="Submit" type="submit">
      </div>
    </form>

  </div>
</div>
@endsection