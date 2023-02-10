@extends('layouts.main')

@section('section')
<div class="col-xl-4">

<div class="card">
    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
        @if ($user[0]->image)
            <img src="{{ asset('storage/'. $user[0]->image) }}" class="img-fluid rounded" alt="{{ $user[0]->name }}">
        @else
            <img src="{{ asset('/') }}assets/img/profile-img.jpg" class="img-fluid rounded" alt="{{ $user[0]->name }}">
        @endif
        <h2 class="text-capitalize">{{ $user[0]->name }}</h2>
        <h3>{{ Str::ucfirst(auth()->user()->level) }}</h3>
    </div>
</div>

</div>

<div class="col-xl-8">

<div class="card">
    <div class="card-body pt-3">

    <ul class="nav nav-tabs nav-tabs-bordered">

        <li class="nav-item">
        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
        </li>

        <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
        </li>

        <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
        </li>

    </ul>
    <div class="tab-content pt-2">

        <div class="tab-pane fade show active profile-overview" id="profile-overview">

        <h5 class="card-title">Profile Details</h5>

        <div class="row">
            <div class="col-lg-3 col-md-4 label ">Full Name</div>
            <div class="col-lg-9 col-md-8 text-capitalize">{{ $user[0]->name }}</div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-4 label">@if(auth()->user()->level == 'mahasiswa') NPM @else NIP @endif</div>
            <div class="col-lg-9 col-md-8">@if(auth()->user()->level == 'mahasiswa') {{ $user[0]->npm }} @else {{ $user[0]->nip }} @endif</div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-4 label">Email</div>
            <div class="col-lg-9 col-md-8 text-lowercase">{{ $user[0]->email }}</div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-4 label">Phone</div>
            <div class="col-lg-9 col-md-8">{{ $user[0]->phone }}</div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-4 label">Gender</div>
            <div class="col-lg-9 col-md-8">@if($user[0]->gender) {{ Str::ucfirst($user[0]->gender) }} @else - @endif</div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-4 label">Place, Date of Birth</div>
            <div class="col-lg-9 col-md-8 text-capitalize">@if($user[0]->birthPlace && $user[0]->birthDate) {{ $user[0]->birthPlace }}, {{ $user[0]->birthDate }} @else - @endif</div>
        </div>

        @if (auth()->user()->level == 'mahasiswa')
            <div class="row">
                <div class="col-lg-3 col-md-4 label">Status</div>
                <div class="col-lg-9 col-md-8"><span class="badge bg-{{ $user[0]->status > 0 ? 'success' : 'danger'}}">{{ $user[0]->status > 0 ? 'APPROVED' : 'DISAPPROVED'}}</span></div>
            </div>
        @endif

        @if(auth()->user()->level == 'dosen')
        <div class="row">
            <div class="col-lg-3 col-md-4 label">Role</div>
            <div class="col-lg-9 col-md-8">

            </div>
        </div>
        @endif

        <p class="text-end text-muted">Updated {{ $user[0]->updated_at->diffForHumans(); }}</p>
        </div>

        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

        <form method="post" action="/{{ auth()->user()->level == 'mahasiswa' ? 'mahasiswa' : 'dosen' }}/profile/{{ $user[0]->slug }}" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="row mb-3">
            <label for="image" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                <div class="col-md-8 col-lg-9">
                    @if ($user[0]->image)
                        <img src="{{ asset('storage/'. $user[0]->image) }}" class="img-preview img-fluid" alt="{{ $user[0]->name }}">
                    @else
                        <img src="{{ asset('/') }}assets/img/profile-img.jpg" class="img-preview img-fluid" alt="{{ $user[0]->name }}">
                    @endif
                    <div class="pt-2">
                        <label for="image" class="label-image" title="Upload my profile image"><i class="bi bi-upload"></i></label>
                        <input type="file" id="image" name="image" onchange="previewImage()">
                        <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                    </div>
                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
            <label for="name" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
            <div class="col-md-8 col-lg-9">
                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name', $user[0]->name) }}" required autocomplete="off">
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            </div>

            @if (auth()->user()->level == 'mahasiswa')
                <div class="row mb-3">
                <label for="npm" class="col-md-4 col-lg-3 col-form-label">NPM</label>
                <div class="col-md-8 col-lg-9">
                    <input name="npm" type="text" class="form-control @error('npm') is-invalid @enderror" id="npm" value="{{ old('npm', $user[0]->npm) }}" required autocomplete="off">
                    @error('npm')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                </div>
            @else 
                <div class="row mb-3">
                <label for="nip" class="col-md-4 col-lg-3 col-form-label">NIP</label>
                <div class="col-md-8 col-lg-9">
                    <input name="nip" type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" value="{{ old('nip', $user[0]->nip) }}" required autocomplete="off">
                    @error('nip')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                </div>
            @endif
            

            <div class="row mb-3">
            <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
            <div class="col-md-8 col-lg-9">
                <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email', $user[0]->email) }}" required autocomplete="off">
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            </div>

            <div class="row mb-3">
            <label for="phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
            <div class="col-md-8 col-lg-9">
                <input name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" value="{{ old('phone', $user[0]->phone) }}" required autocomplete="off">
                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            </div>

            <div class="row mb-3">
            <label class="col-md-4 col-lg-3 col-form-label">Gender</label>
            <div class="col-md-8 col-lg-9">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" value="male" @if(old('gender', $user[0]->gender) == 'male') checked @endif>
                    <label class="form-check-label" for="gridRadios1">
                      Male
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" value="female" @if(old('gender', $user[0]->gender) == 'female') checked @endif>
                    <label class="form-check-label" for="gridRadios2">
                      Female
                    </label>
                  </div>
                  @error('gender') <div class="invalid-feedback"> {{ $message }} </div> @enderror
            </div>
            </div>

            <div class="row mb-3">
            <label for="birthPlace" class="col-md-4 col-lg-3 col-form-label">Place of Birth</label>
            <div class="col-md-8 col-lg-9">
                <input name="birthPlace" type="text" class="form-control @error('birthPlace') is-invalid @enderror" id="birthPlace" value="{{ old('birthPlace', $user[0]->birthPlace) }}" required autocomplete="off">
                @error('birthPlace')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            </div>

            <div class="row mb-3">
            <label for="birthDate" class="col-md-4 col-lg-3 col-form-label">Date of Birth</label>
            <div class="col-md-8 col-lg-9">
                <input name="birthDate" type="date" class="form-control @error('birthDate') is-invalid @enderror" id="birthDate" value="{{ old('birthDate', $user[0]->birthDate) }}" required>
                @error('datePlace')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            </div>

            <div class="text-center">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>

        </div>

        <div class="tab-pane fade pt-3" id="profile-change-password">

        <form method="post" action="{{ url('/password') }}">
            @method('put')
            @csrf
            <div class="row mb-3">
            <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
            <div class="col-md-8 col-lg-9">
                <input name="oldPassword" id="currentPassword" type="password" class="form-control @error('oldPassword') is-invalid @enderror" required>
                @error('oldPassword')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            </div>

            <div class="row mb-3">
            <label for="password" class="col-md-4 col-lg-3 col-form-label">New Password</label>
            <div class="col-md-8 col-lg-9">
                <input name="password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" required />
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            </div>

            <div class="text-center">
            <button type="submit" class="btn btn-primary">Change Password</button>
            </div>
        </form>

        </div>

    </div>

    </div>
</div>

</div>
@endsection