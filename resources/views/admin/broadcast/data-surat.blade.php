@if ($list === '0')
    <div class="alert alert-warning" role="alert">
        Belum ada surat yang menunggu untuk disiarkan!
    </div>
@else
<div class="row">
    @foreach ($list[0] as $key => $file)
    <div class="col-md-3">
        <div class="card">
            <h5 class="card-title text-center">{{ $name[$key] }}</h5>
            <img src="{{ asset('/') }}assets/img/{{ $icon[$key] }}" class="card-img-top w-75 h-75 mx-auto d-block mb-4" alt="...">
            <div class="card-body">
                <div class="col-12">
                    <p class="card-text"><a href="#" class="btn btn-danger btn-md w-100" id="btn-delete-file" data-id="{{ $file }}"><i class="bi bi-x-circle"></i> Delete</a></p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif