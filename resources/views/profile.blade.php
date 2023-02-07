@extends('layouts.main')

@section('section')
@foreach ($data['data'] as $user)
<div class="col-xl-4">

<div class="card">
    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

    <img src="{{ asset('assets/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
    <h2>{{ $user->name }}</h2>
    <h3>{{ auth()->user()->level }}</h3>
    </div>
</div>

</div>

<div class="col-xl-8">

<div class="card">
    <div class="card-body pt-3">
    <!-- Bordered Tabs -->
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
            <div class="col-lg-9 col-md-8">{{ $user->name }}</div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-4 label">@if(auth()->user()->level == 'mahasiswa') NPM @else NIP @endif</div>
            <div class="col-lg-9 col-md-8">@if(auth()->user()->level == 'mahasiswa') {{ $user->npm }} @else {{ $user->nip }} @endif</div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-4 label">Email</div>
            <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-4 label">Phone</div>
            <div class="col-lg-9 col-md-8">{{ $user->phone }}</div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-4 label">Gender</div>
            <div class="col-lg-9 col-md-8">@if($user->gender) {{ $user->gender }} @else - @endif</div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-4 label">Place, Date of Birth</div>
            <div class="col-lg-9 col-md-8">@if($user->birthPlace && $user->birthDate) {{ $user->birthPlace }}, {{ $user->birthDate }} @else - @endif</div>
        </div>

        @if (auth()->user()->level == 'mahasiswa')
            <div class="row">
                <div class="col-lg-3 col-md-4 label">Status</div>
                <div class="col-lg-9 col-md-8"><span class="badge bg-{{ $user->status > 0 ? 'success' : 'danger'}}">{{ $user->status > 0 ? 'approved' : 'disapprove'}}</span></div>
            </div>
        @endif

        @if(auth()->user()->level == 'dosen')
        <div class="row">
            <div class="col-lg-3 col-md-4 label">Role</div>
            <div class="col-lg-9 col-md-8">
                @foreach ($data['roles'] as $role)
                    {{ $role->role->role }}
                @endforeach
            </div>
        </div>
        @endif

        <p class="text-end text-muted">Updated {{ $user->updated_at->diffForHumans(); }}</p>
        </div>

        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

        <!-- Profile Edit Form -->
        <form method="post" action="/{{ auth()->user()->level == 'mahasiswa' ? 'mahasiswa' : (auth()->user()->level == 'dosen' ? 'dosen' : 'superadmin') }}/profile/{{ $user->id }}">
            @method('put')
            @csrf
            <div class="row mb-3">
            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
            <div class="col-md-8 col-lg-9">
                <img src="assets/img/profile-img.jpg" alt="Profile">
                <div class="pt-2">
                <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                </div>
            </div>
            </div>

            <div class="row mb-3">
            <label for="name" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
            <div class="col-md-8 col-lg-9">
                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name', $user->name) }}" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            </div>

            @if (auth()->user()->level == 'mahasiswa')
                <div class="row mb-3">
                <label for="npm" class="col-md-4 col-lg-3 col-form-label">NPM</label>
                <div class="col-md-8 col-lg-9">
                    <input name="npm" type="text" class="form-control @error('npm') is-invalid @enderror" id="npm" value="{{ old('npm', $user->npm) }}" required>
                    @error('npm')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                </div>
            @else 
                <div class="row mb-3">
                <label for="nip" class="col-md-4 col-lg-3 col-form-label">NIP</label>
                <div class="col-md-8 col-lg-9">
                    <input name="nip" type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" value="{{ old('nip', $user->nip) }}" required>
                    @error('nip')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                </div>
            @endif
            

            <div class="row mb-3">
            <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
            <div class="col-md-8 col-lg-9">
                <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email', $user->email) }}" required>
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            </div>

            <div class="row mb-3">
            <label for="phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
            <div class="col-md-8 col-lg-9">
                <input name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" value="{{ old('phone', $user->phone) }}" required>
                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            </div>

            <div class="row mb-3">
            <label class="col-md-4 col-lg-3 col-form-label">Gender</label>
            <div class="col-md-8 col-lg-9">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" value="male" @if(old('gender', $user->gender) == 'male') checked @endif>
                    <label class="form-check-label" for="gridRadios1">
                      Male
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" value="female" @if(old('gender', $user->gender) == 'female') checked @endif>
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
                <input name="birthPlace" type="text" class="form-control @error('birthPlace') is-invalid @enderror" id="birthPlace" value="{{ old('birthPlace', $user->birthPlace) }}" required>
                @error('birthPlace')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            </div>

            <div class="row mb-3">
            <label for="birthDate" class="col-md-4 col-lg-3 col-form-label">Date of Birth</label>
            <div class="col-md-8 col-lg-9">
                <input name="birthDate" type="date" class="form-control @error('birthDate') is-invalid @enderror" id="birthDate" value="{{ old('birthDate', $user->birthDate) }}" required>
                @error('datePlace')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            </div>

            <div class="text-center">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form><!-- End Profile Edit Form -->

        </div>

        <div class="tab-pane fade pt-3" id="profile-change-password">
        <!-- Change Password Form -->
        <form method="post" action="{{ url('password') }}">
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
        </form><!-- End Change Password Form -->

        </div>

    </div><!-- End Bordered Tabs -->

    </div>
</div>

</div>
@endforeach
@endsection