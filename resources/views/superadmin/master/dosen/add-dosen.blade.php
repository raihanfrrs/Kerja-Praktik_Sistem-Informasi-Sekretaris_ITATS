@extends('layouts.main')

@section('section')
<div class="card">
    <div class="card-body">
      <h5 class="card-title">Dosen <span>| Add</span></h5>

      <!-- General Form Elements -->
      <form action="{{ url('/master/dosen') }}" method="post">
        @csrf
        <div class="row mb-3">
          <label for="name" class="col-sm-2 col-form-label">Full Name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control @error('name') @enderror" id="name" name="name" value="{{ old('name') }}">
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>
        </div>
        <div class="row mb-3">
          <label for="nip" class="col-sm-2 col-form-label">NIP</label>
          <div class="col-sm-10">
            <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip"  value="{{ old('nip') }}">
            @error('nip') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>
        </div>
        <div class="row mb-3">
          <label for="email" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"  value="{{ old('email') }}">
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>
        </div>
        <div class="row mb-3">
          <label for="phone" class="col-sm-2 col-form-label">Phone</label>
          <div class="col-sm-10">
            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"  value="{{ old('phone') }}">
            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>
        </div>
        <div class="row mb-3">
            <label for="birthPlace" class="col-sm-2 col-form-label">Place of Birth</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('birthPlace') is-invalid @enderror" id="birthPlace" name="birthPlace"  value="{{ old('birthPlace') }}">
              @error('birthPlace') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
        <div class="row mb-3">
            <label for="birthDate" class="col-sm-2 col-form-label">Date of Birth</label>
            <div class="col-sm-10">
              <input type="date" class="form-control @error('birthDate') is-invalid @enderror" id="birthDate" name="birthDate"  value="{{ old('birthDate') }}">
              @error('birthDate') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
        <div class="row mb-3">
            <label for="username" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username"  value="{{ old('username') }}">
              @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
        <div class="row mb-3">
            <label for="password" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control @error('passwprd') is-invalid @enderror" id="password" name="password" >
              @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
          </div>
        <fieldset class="row mb-3">
          <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
          <div class="col-sm-10">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="gender" id="male" value="male" @if(old('gender') == 'male') checked @endif>
              <label class="form-check-label" for="male">
                Male
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="gender" id="female" value="female" @if(old('gender') == 'female') checked @endif>
              <label class="form-check-label" for="female">
                Female
              </label>
            </div>
            @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>
        </fieldset>
        <div class="row mb-3">
          <legend class="col-form-label col-sm-2 pt-0">Roles</legend>
          <div class="col-sm-10">
            @foreach ($roles as $role)
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="{{ $role->role }}" name="role[]" value="{{ $role->id }}" @if(old('role') == $role->id) checked @endif>
                <label class="form-check-label" for="{{ $role->role }}">
                  {{ $role->role }}
                </label>
              </div>
            @endforeach
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
            <a href="{{ url('master/dosen') }}" class="btn btn-danger">Back</a>
          </div>
        </div>

      </form><!-- End General Form Elements -->

    </div>
</div>
@endsection