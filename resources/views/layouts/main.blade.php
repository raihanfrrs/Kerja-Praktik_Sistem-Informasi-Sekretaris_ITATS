<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Sekretaris 
    @if (count(Request::segments()) == 0)
        - Dashboard
    @else 
        -  {{ isset($subtitle) ? $subtitle : Str::ucfirst(request()->segment(count(request()->segments()))) }}
    @endif
  </title>

  <!-- Favicons -->
  <link href="{{ asset('assets/img/Logo_ITATS-2.png') }}" rel="icon">

  <!-- Vendor JS Files -->
  <script src="{{ asset('/') }}assets/vendor/sweetalert2/js/sweetalert2.min.js"></script>

  <!-- Vendor CSS Files -->
  <link href="{{ asset('/') }}assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('/') }}assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ asset('/') }}assets/vendor/sweetalert2/css/sweetalert2.min.css" rel="stylesheet">
  <link href="{{ asset('/') }}assets/vendor/datatables/css/datatables.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('/') }}assets/css/style.css" rel="stylesheet">
</head>

<body>

  @auth
    @include('partials.navbar')

    @include('partials.sidebar')
  @endauth

  <main @auth id="main" class="main" @endauth>
    @auth
      @include('partials.title-wrapper')
    @endauth

    @auth
    <section @if(request()->is('profile')) class='section profile' @else class='section dashboard' @endif>
      @include('partials.flash')
      <div class="row">
        @yield('section')
      </div>
    </section>
    @else
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
            @yield('section')
          </div>
        </div>
      </div>
    </section>
    @endauth

  </main>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('/') }}assets/vendor/jquery/jquery-3.6.3.min.js"></script>
  <script src="{{ asset('/') }}assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('/') }}assets/vendor/datatables/js/datatables.min.js"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('/') }}assets/js/main.js"></script>
  <script src="{{ asset('/') }}assets/js/datatables.js"></script>
  <script src="{{ asset('/') }}assets/js/images.js"></script>
  <script src="{{ asset('/') }}assets/js/button.js"></script>

  @stack('scripts')
</body>

</html>