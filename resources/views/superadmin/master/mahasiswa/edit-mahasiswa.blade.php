@extends('layouts.main')

@section('section')
<div class="col-md-7">
    <form action="/mahasiswa/{{ $mahasiswa[0]->slug }}" method="post" enctype="multipart/form-data">
    @method('put')
    @csrf
    <div class="card">
        <div class="card-body">
        <h5 class="card-title">Mahasiswa <span>| Edit</span></h5>

            <div class="row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Full Name</label>
                <div class="col-sm-10">
                <input type="text" class="form-control @error('name') is-invalid @enderror text-capitalize" id="name" name="name" required value="{{ old('name', $mahasiswa[0]->name) }}" autocomplete="off">
                @error('name') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="npm" class="col-sm-2 col-form-label">NPM</label>
                <div class="col-sm-10">
                <input type="text" class="form-control @error('npm') is-invalid @enderror" id="npm" name="npm" required value="{{ old('npm', $mahasiswa[0]->npm) }}" autocomplete="off">
                @error('npm') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                <input type="email" class="form-control @error('email') is-invalid @enderror text-lowercase" id="email" name="email" required value="{{ old('email', $mahasiswa[0]->email) }}" autocomplete="off">
                @error('email') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                <div class="col-sm-10">
                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" required value="{{ old('phone', $mahasiswa[0]->phone) }}" autocomplete="off">
                @error('phone') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="birthPlace" class="col-sm-2 col-form-label">Place of Birth</label>
                <div class="col-sm-10">
                <input type="text" class="form-control @error('birthPlace') is-invalid @enderror text-capitalize" id="birthPlace" name="birthPlace" required value="{{ old('birthPlace', $mahasiswa[0]->birthPlace) }}" autocomplete="off">
                @error('birthPlace') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="birthDate" class="col-sm-2 col-form-label">Date of Birth</label>
                <div class="col-sm-10">
                <input type="date" class="form-control @error('birthDate') is-invalid @enderror" id="birthDate" name="birthDate" required value="{{ old('birthDate', $mahasiswa[0]->birthDate) }}">
                @error('birthDate') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                </div>
            </div>
            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" value="male" @if(old('gender', $mahasiswa[0]->gender) == 'male') checked @endif>
                    <label class="form-check-label" for="gridRadios1">
                    Male
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" value="female" @if(old('gender', $mahasiswa[0]->gender) == 'female') checked @endif>
                    <label class="form-check-label" for="gridRadios2">
                    Female
                    </label>
                </div>
                @error('gender') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                </div>
            </fieldset>
    
        </div>
    </div>
</div>
<div class="col-md-5">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Mahasiswa <span>| Image</span></h5>
            <div class="row">
                <label for="image" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" onchange="previewImage()">
                    @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    @if ($mahasiswa[0]->image)
                        <img src="{{ asset('storage/'.$mahasiswa[0]->image) }}" class="img-preview img-fluid mt-3">
                    @else
                        <img class="img-preview img-fluid mt-3">
                    @endif
                </div>
            </div>

            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Submit</button>
            </div>
        </div>
    </div>
    </form>
</div>
@endsection