<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{ isset($title) ? $title." - " : '' }} {{ isset($subtitle) ? $subtitle : Str::ucfirst(request()->segment(count(request()->segments()))) }}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">


  <!-- Vendor CSS Files -->
  <link href="{{ asset('/') }}assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('/') }}assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ asset('/') }}assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="{{ asset('/') }}assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="{{ asset('/') }}assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="{{ asset('/') }}assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="{{ asset('/') }}assets/vendor/simple-datatables/style.css" rel="stylesheet">

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
    <div class="pagetitle">
      <h1>{{ isset($title) ? $title : Str::ucfirst(request()->segment(count(request()->segments()))) }}</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          @if (request()->is('master/*'))
          <li class="breadcrumb-item">Master</li>
          @endif
          <li class="breadcrumb-item active"><a href="{{ URL::current(); }}">{{ isset($subtitle) ? $subtitle : Str::ucfirst(request()->segment(count(request()->segments()))) }}</a></li>
        </ol>
      </nav>
    </div>
    @endauth

    @auth
    <section @if(request()->is(auth()->user()->level.'/profile')) class='section profile' @else class='section dashboard' @endif>
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

  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('/') }}assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="{{ asset('/') }}assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('/') }}assets/vendor/chart.js/chart.min.js"></script>
  <script src="{{ asset('/') }}assets/vendor/echarts/echarts.min.js"></script>
  <script src="{{ asset('/') }}assets/vendor/quill/quill.min.js"></script>
  <script src="{{ asset('/') }}assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="{{ asset('/') }}assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="{{ asset('/') }}assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('/') }}assets/js/main.js"></script>

</body>

</html>