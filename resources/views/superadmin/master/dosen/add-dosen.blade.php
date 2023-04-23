@extends('layouts.main')

@section('section')
<div class="col-md-7">
  <form action="/dosen" method="post" enctype="multipart/form-data">
  @csrf
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Dosen <span>| Tambah</span></h5>

        <div class="row mb-3">
          <label for="name" class="col-sm-4 col-form-label">Nama Lengkap</label>
          <div class="col-sm-8">
            <input type="text" class="form-control @error('name') @enderror text-capitalize" id="name" name="name" value="{{ old('name') }}" required autocomplete="off" placeholder="Nama Lengkap">
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>
        </div>
        <div class="row mb-3">
          <label for="nip" class="col-sm-4 col-form-label">NIP</label>
          <div class="col-sm-8">
            <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip" value="{{ old('nip') }}" required autocomplete="off" placeholder="NIP">
            @error('nip') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>
        </div>
        <div class="row mb-3">
          <label for="email" class="col-sm-4 col-form-label">Email</label>
          <div class="col-sm-8">
            <input type="email" class="form-control @error('email') is-invalid @enderror text-lowercase" id="email" name="email" value="{{ old('email') }}" required autocomplete="off" placeholder="Email">
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>
        </div>
        <div class="row mb-3">
          <label for="phone" class="col-sm-4 col-form-label">Nomor HP</label>
          <div class="col-sm-8">
            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required autocomplete="off" placeholder="Nomor HP">
            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>
        </div>
        <div class="row mb-3">
            <label for="birthPlace" class="col-sm-4 col-form-label">Tempat Lahir</label>
            <div class="col-sm-8">
              <input type="text" class="form-control @error('birthPlace') is-invalid @enderror text-capitalize" id="birthPlace" name="birthPlace" value="{{ old('birthPlace') }}" required autocomplete="off" placeholder="Tempat Lahir">
              @error('birthPlace') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
        <div class="row mb-3">
            <label for="birthDate" class="col-sm-4 col-form-label">Tanggal Lahir</label>
            <div class="col-sm-8">
              <input type="date" class="form-control @error('birthDate') is-invalid @enderror" id="birthDate" name="birthDate" value="{{ old('birthDate') }}" required>
              @error('birthDate') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
        <fieldset class="row mb-3">
          <legend class="col-form-label col-sm-4 pt-0">Jenis Kelamin</legend>
          <div class="col-sm-8">
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
          <legend class="col-form-label col-sm-4 pt-0">Jabatan</legend>
          <div class="col-sm-8">
            @foreach ($roles as $role)
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="{{ $role->slug }}" name="role_id[]" value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'checked' : '' }}>
              <label class="form-check-label" for="{{ $role->slug }}">{{ $role->role }}</label>
            </div>
            @endforeach
            @if($errors->any())
            @php
                $error = $errors->getBags()['default']->get('role_id');
            @endphp
              <span class="text-danger">{{$error[0]}}</span>
            @endif
          </div>
        </div>
        <div class="row mb-3">
          <label for="username" class="col-sm-4 col-form-label">Username</label>
          <div class="col-sm-8">
            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" required autocomplete="off" placeholder="Username">
            @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>
        </div>
        <div class="row mb-3">
            <label for="password" class="col-sm-4 col-form-label">Kata Sandi</label>
            <div class="col-sm-8">
              <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" autocomplete="off" required placeholder="Kata Sandi">
              @if ($errors->any())
                <div class="invalid-feedback">
                  <ul>
                    @foreach ($errors->getBags()['default']->get('password') as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
            </div>
        </div>

    </div>
  </div>
</div>
<div class="col-md-5">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Dosen <span>| Foto Profil</span><sup class="text-danger">*Opsional</sup></h5>
      <div class="row">
        <label for="image" class="col-sm-4 col-form-label">Foto Profil</label>
        <div class="col-sm-8">
          <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" onchange="previewImage()">
          @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
          <img class="img-preview img-fluid mt-3">
        </div>
      </div>
      
      <div class="text-center mt-3">
        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Kirim</button>
      </div>
    </div>
  </div>
  </form>
</div>
@endsection