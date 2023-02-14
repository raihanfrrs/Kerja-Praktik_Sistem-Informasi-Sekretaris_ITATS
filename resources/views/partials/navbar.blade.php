<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ url('/') }}" class="logo d-flex align-items-center">
          <img src="{{ asset('assets/img/Logo_ITATS.png') }}" alt="logoITATS">
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        @if (auth()->user()->level === 'superadmin')
        <li class="nav-item">

          <a class="nav-link nav-icon" href="#">
            <i class="bi bi-archive"></i>
            @if (Session::get('archive') != 0)
              <span class="badge bg-primary badge-number">{{ Session::get('archive') }}</span>
            @endif
          </a>
        </li>

        <li class="nav-item">

          <a class="nav-link nav-icon" href="/recycle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="">
            <i class="bi bi-recycle"></i>
            @if (Session::get('recycle') != 0)
              <span class="badge bg-success badge-number">{{ Session::get('recycle') }}</span>
            @endif
          </a>
        </li>
        @endif

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            @if (auth()->user()->level === 'mahasiswa')
              @if (auth()->user()->mahasiswa->image)
                  <img src="{{ asset('storage/'. auth()->user()->mahasiswa->image) }}" class="img-fluid rounded" alt="{{ auth()->user()->mahasiswa->name }}">
              @else
                  <img src="{{ asset('/') }}assets/img/profile-img.jpg" class="img-fluid rounded" alt="{{ auth()->user()->mahasiswa->name }}">
              @endif
            @else
              @if (auth()->user()->dosen->image)
                  <img src="{{ asset('storage/'. auth()->user()->dosen->image) }}" class="img-fluid" alt="{{ auth()->user()->dosen->name }}">
              @else
                  <img src="{{ asset('/') }}assets/img/profile-img.jpg" class="img-fluid" alt="{{ auth()->user()->dosen->name }}">
              @endif
            @endif
            <span class="d-none d-md-block dropdown-toggle ps-2">
              @if (auth()->user()->level == 'mahasiswa')
                {{ auth()->user()->mahasiswa->name }}
              @else
                {{ auth()->user()->dosen->name }}
              @endif
            </span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>
                @if (auth()->user()->level == 'mahasiswa')
                  {{ auth()->user()->mahasiswa->name }}
                @else
                  {{ auth()->user()->dosen->name }}
                @endif
              </h6>
              <span>{{ Str::ucfirst(auth()->user()->level) }}</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ url('/profile') }}">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ url('/logout') }}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->