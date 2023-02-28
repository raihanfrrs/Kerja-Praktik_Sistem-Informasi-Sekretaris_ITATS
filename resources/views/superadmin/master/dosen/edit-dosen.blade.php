@extends('layouts.main')

@section('section')
<div class="col-md-7">
    <form action="/dosen/{{ $dosen->slug }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="card">
            <div class="card-body">
            <h5 class="card-title">Dosen <span>| Edit</span></h5>
        
                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label">Full Name</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required value="{{ old('name', $dosen->name) }}" autocomplete="off">
                    @error('name') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nip" class="col-sm-2 col-form-label">NIP</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip" required value="{{ old('nip', $dosen->nip) }}" autocomplete="off">
                    @error('npm') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required value="{{ old('email', $dosen->email) }}" autocomplete="off">
                    @error('email') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" required value="{{ old('phone', $dosen->phone) }}" autocomplete="off">
                    @error('phone') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="birthPlace" class="col-sm-2 col-form-label">Place of Birth</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control @error('birthPlace') is-invalid @enderror" id="birthPlace" name="birthPlace" required value="{{ old('birthPlace', $dosen->birthPlace) }}" autocomplete="off">
                    @error('birthPlace') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="birthDate" class="col-sm-2 col-form-label">Date of Birth</label>
                    <div class="col-sm-10">
                    <input type="date" class="form-control @error('birthDate') is-invalid @enderror" id="birthDate" name="birthDate" required value="{{ old('birthDate', $dosen->birthDate) }}">
                    @error('birthDate') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                </div>
                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                    <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" value="male" @if(old('gender', $dosen->gender) == 'male') checked @endif>
                        <label class="form-check-label" for="gridRadios1">
                        Male
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" value="female" @if(old('gender', $dosen->gender) == 'female') checked @endif>
                        <label class="form-check-label" for="gridRadios2">
                        Female
                        </label>
                    </div>
                    @error('gender') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                </fieldset>
                <div class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Roles</legend>
                    <div class="col-sm-10">
                        @foreach ($roles as $role)
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="role_id[]" id="{{ $role->slug }}" {{ in_array(old('role_id', $role->id), $data) ? 'checked' : '' }} value="{{ $role->slug }}">
                                <label class="form-check-label" for="{{ $role->slug }}">{{ $role->role }}</label>
                            </div>
                        @endforeach
                        @if($errors->any())
                        @php
                            $error = $errors->getBags()['default']->get('role');
                        @endphp
                        <span class="text-danger">{{$error[0]}}</span>
                        @endif
                    </div>
                </div>
        
            </div>
        </div>
</div>
<div class="col-md-5">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Dosen <span>| Image</span></h5>
            <div class="row">
                <label for="image" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" onchange="previewImage()">
                    @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    @if ($dosen->image)
                        <img src="{{ asset('storage/'.$dosen->image) }}" class="img-preview img-fluid mt-3">
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
</div>
@endsection