<div class="pagetitle">
    <h1 class="float-start">
      @if (count(Request::segments()) == 0)
          Dashboard
      @else 
          {{ isset($title) ? $title : Str::ucfirst(Request::segment(1)) }}
      @endif
    </h1>
    <nav class="d-flex justify-content-end">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/dashboard">Dashboard</a>
        </li>
        @if (count(Request::segments()) >= 1)
          @if(request()->is(Request::segment(1)."/*"))
            <a href="{{ url()->previous() }}" class="breadcrumb-item">{{ Str::ucfirst(Request::segment(1)) }}</a>
          @endif
          <li class="breadcrumb-item @if(request()->segment(count(request()->segments()))) active @endif">
            <a href="{{ url()->current() }}">
                {{ isset($subtitle) ? Str::ucfirst($subtitle) : Str::ucfirst(request()->segment(count(request()->segments()))) }}
            </a>
          </li>
        @endif
      </ol>
    </nav>
</div>