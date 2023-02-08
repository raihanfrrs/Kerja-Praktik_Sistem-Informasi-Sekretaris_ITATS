@extends('layouts.main')

@section('section')
<div class="card">
    <div class="card-body">
    <h5 class="card-title">Dosen <span>| Edit</span></h5>
    <form action="/dosen/{{ $dosen[0]->slug }}" method="post">
        @method('put')
        @csrf
        <div class="row mb-3">
            <label for="name" class="col-sm-2 col-form-label">Full Name</label>
            <div class="col-sm-10">
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required value="{{ old('name', $dosen[0]->name) }}">
            @error('name') <div class="invalid-feedback"> {{ $message }} </div> @enderror
            </div>
        </div>
        <div class="row mb-3">
            <label for="nip" class="col-sm-2 col-form-label">NIP</label>
            <div class="col-sm-10">
            <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip" required value="{{ old('nip', $dosen[0]->nip) }}">
            @error('npm') <div class="invalid-feedback"> {{ $message }} </div> @enderror
            </div>
        </div>
        <div class="row mb-3">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required value="{{ old('email', $dosen[0]->email) }}">
            @error('email') <div class="invalid-feedback"> {{ $message }} </div> @enderror
            </div>
        </div>
        <div class="row mb-3">
            <label for="phone" class="col-sm-2 col-form-label">Phone</label>
            <div class="col-sm-10">
            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" required value="{{ old('phone', $dosen[0]->phone) }}">
            @error('phone') <div class="invalid-feedback"> {{ $message }} </div> @enderror
            </div>
        </div>
        <div class="row mb-3">
            <label for="birthPlace" class="col-sm-2 col-form-label">Place of Birth</label>
            <div class="col-sm-10">
            <input type="text" class="form-control @error('birthPlace') is-invalid @enderror" id="birthPlace" name="birthPlace" required value="{{ old('birthPlace', $dosen[0]->birthPlace) }}">
            @error('birthPlace') <div class="invalid-feedback"> {{ $message }} </div> @enderror
            </div>
        </div>
        <div class="row mb-3">
            <label for="birthDate" class="col-sm-2 col-form-label">Date of Birth</label>
            <div class="col-sm-10">
            <input type="date" class="form-control @error('birthDate') is-invalid @enderror" id="birthDate" name="birthDate" required value="{{ old('birthDate', $dosen[0]->birthDate) }}">
            @error('birthDate') <div class="invalid-feedback"> {{ $message }} </div> @enderror
            </div>
        </div>
        <fieldset class="row mb-3">
            <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
            <div class="col-sm-10">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" value="male" @if(old('gender', $dosen[0]->gender) == 'male') checked @endif>
                <label class="form-check-label" for="gridRadios1">
                Male
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" value="female" @if(old('gender', $dosen[0]->gender) == 'female') checked @endif>
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
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Create</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                    <label class="form-check-label" for="flexSwitchCheckChecked">Read</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Update</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Delete</label>
                </div>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
            <a href="{{ url('/dosen') }}" class="btn btn-danger">Back</a>
        </div>

    </form>

    </div>
</div>
@endsection