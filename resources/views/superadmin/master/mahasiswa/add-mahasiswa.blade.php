@extends('layouts.main')

@section('section')
<div class="col-md-7">
<form action="/mahasiswa" method="post" enctype="multipart/form-data">
@csrf
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Mahasiswa <span>| Tambah</span></h5>
  
      <div class="row mb-3">
        <label for="name" class="col-sm-4 col-form-label">Nama Lengkap</label>
        <div class="col-sm-8">
          <input type="text" class="form-control @error('name') @enderror text-capitalize" id="name" name="name" value="{{ old('name') }}" required autocomplete="off" placeholder="Nama Lengkap">
          @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>
      <div class="row mb-3">
        <label for="npm" class="col-sm-4 col-form-label">NPM</label>
        <div class="col-sm-8">
          <input type="text" class="form-control @error('npm') is-invalid @enderror" id="npm" name="npm" value="{{ old('npm') }}" required autocomplete="off" placeholder="NPM">
          @error('npm') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
          <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"  value="{{ old('phone') }}" required autocomplete="off" placeholder="Nomor HP">
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
              Laki-laki
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" id="female" value="female" @if(old('gender') == 'female') checked @endif>
            <label class="form-check-label" for="female">
              Perempuan
            </label>
          </div>
          @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </fieldset>
      <div class="row mb-3">
          <label for="username" class="col-sm-4 col-form-label">Username</label>
          <div class="col-sm-8">
            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username"  value="{{ old('username') }}" required autocomplete="off" placeholder="Username">
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
      <h5 class="card-title">Mahasiswa <span>| Foto Profil</span></h5>
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
        <a href="{{ url('/mahasiswa') }}" class="btn btn-warning"><i class="bi bi-arrow-bar-left"></i> Kembali</a>
      </div>  
    </div>
  </div>
</form>
</div>
@endsection