@extends('layouts.main')

@section('section')
<div class="card">
    <div class="card-body">
      <h5 class="card-title">Mahasiswa <span>| Add</span></h5>

      <!-- Floating Labels Form -->
      <form class="row g-3" action="{{ url('/mahasiswa') }}" method="post">
        @csrf
        <div class="col-md-12">
          <div class="form-floating">
            <input type="text" class="form-control @error('name') is-invalid @enderror text-capitalize" id="name" name="name" placeholder="Full Name" required value="{{ old('name') }}" autocomplete="off">
            <label for="name">Full Name</label>
          </div>
          @error('name') <div class="invalid-feedback"> {{ $message }} </div> @enderror
        </div>
        <div class="col-md-4">
          <div class="form-floating">
            <input type="text" class="form-control @error('npm') is-invalid @enderror" id="npm" name="npm" placeholder="NPM" required value="{{ old('npm') }}" autocomplete="off">
            <label for="npm">NPM</label>
          </div>
          @error('npm') <div class="invalid-feedback"> {{ $message }} </div> @enderror
        </div>
        <div class="col-md-4">
          <div class="form-floating">
            <input type="email" class="form-control @error('email') is-invalid @enderror text-lowercase" id="email" name="email" placeholder="Email" required value="{{ old('email') }}" autocomplete="off">
            <label for="email">Email</label>
          </div>
          @error('email') <div class="invalid-feedback"> {{ $message }} </div> @enderror
        </div>
        <div class="col-md-4">
            <div class="form-floating">
              <input type="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="Phone" required value="{{ old('phone') }}" autocomplete="off">
              <label for="phone">Phone</label>
            </div>
            @error('phone') <div class="invalid-feedback"> {{ $message }} </div> @enderror
          </div>
        <div class="col-md-6">
          <div class="col-md-12">
            <div class="form-floating">
              <input type="text" class="form-control @error('birthPlace') is-invalid @enderror text-capitalize" id="birthPlace" name='birthPlace' placeholder="Birth of Place" required value="{{ old('birthPlace') }}" autocomplete="off">
              <label for="birthPlace">Birth of Place</label>
            </div>
            @error('birthPlace') <div class="invalid-feedback"> {{ $message }} </div> @enderror
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-floating">
            <input type="date" class="form-control @error('birthDate') is-invalid @enderror" id="birthDate" name="birthDate" placeholder="Date of Birth" required value="{{ old('birthDate') }}">
            <label for="birthDate">Date of Birth</label>
          </div>
          @error('birthDate') <div class="invalid-feedback"> {{ $message }} </div> @enderror
        </div>
        <div class="col-md-2">
            <div class="form-floating mb-3">
              <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" aria-label="gender" required>
                <option value="male" @if(old('gender') == 'male') selected @endif>Male</option>
                <option value="female" @if(old('gender') == 'female') selected @endif>Female</option>
              </select>
              <label for="gender">Gender</label>
            </div>
            @error('gender') <div class="invalid-feedback"> {{ $message }} </div> @enderror
        </div>
        <div class="col-md-6">
            <div class="form-floating">
              <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Username" required value="{{ old('username') }}" autocomplete="off">
              <label for="username">Username</label>
            </div>
            @error('username') <div class="invalid-feedback"> {{ $message }} </div> @enderror
          </div>
          <div class="col-md-6">
            <div class="form-floating">
              <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required>
              <label for="password">Password</label>
            </div>
            @error('password') <div class="invalid-feedback"> {{ $message }} </div> @enderror
          </div>

        <div class="text-center mt-5">
          <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Submit</button>
          <button type="reset" class="btn btn-secondary"><i class="bi bi-arrow-clockwise"></i> Reset</button>
          <a href="{{ url('/mahasiswa') }}" class="btn btn-warning"><i class="bi bi-arrow-bar-left"></i> Back</a>
        </div>
      </form><!-- End floating Labels Form -->

    </div>
  </div>
@endsection