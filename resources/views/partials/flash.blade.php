@if (session('case') == 'default')
    <div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('case') == 'solid')
    <div class="alert alert-{{ session('type') }} bg-{{ session('type') }} text-light border-0 alert-dismissible fade show" role="alert">
        {{ session('message') }}
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('case') == 'heading')
<div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
    <h4 class="alert-heading">{{ session('head') }}</h4>
    <p>{{ session('message') }}</p>
    @if(session()->has('foot'))
    <hr>
    <p class="mb-0">{{ session('foot') }}</p>
    @endif
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif