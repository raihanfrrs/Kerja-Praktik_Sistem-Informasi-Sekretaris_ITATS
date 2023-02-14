@extends('layouts.main')

@section('section')
<div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Dosen <span>| Image</span></h5>
            <div class="d-flex flex-column align-items-center">
                @if ($dosen[0]->image)
                <img src="{{ asset('storage/'. $dosen[0]->image) }}" class="img-fluid rounded" alt="{{ $dosen[0]->name }}">
                @else
                    <img src="{{ asset('/') }}assets/img/profile-img.jpg" class="img-fluid rounded" alt="{{ $dosen[0]->name }}">
                @endif
            </div>
        </div>
    </div>
</div>

<div class="col-md-8">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Dosen <span>| Details</span></h5>
    
            <div class="d-grid gap-3">
                <div class="row">
                    <div class="col-lg-3 col-md-4 label text-muted">Full Name</div>
                    <div class="col-lg-9 col-md-8 text-capitalize">{{ $dosen[0]->name }}</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 text-muted">NIP</div>
                    <div class="col-lg-9 col-md-8">{{ $dosen[0]->nip }}</div>
                </div>
    
                <div class="row">
                    <div class="col-lg-3 col-md-4 text-muted">Email</div>
                    <div class="col-lg-9 col-md-8 text-lowercase">{{ $dosen[0]->email }}</div>
                </div>
    
                <div class="row">
                    <div class="col-lg-3 col-md-4 text-muted">Phone</div>
                    <div class="col-lg-9 col-md-8">{{ $dosen[0]->phone }}</div>
                </div>
    
                <div class="row">
                    <div class="col-lg-3 col-md-4 label text-muted">Place, Date of Birth</div>
                    <div class="col-lg-9 col-md-8 text-capitalize">@if($dosen[0]->birthPlace && $dosen[0]->birthDate) {{ $dosen[0]->birthPlace }}, {{ $dosen[0]->birthDate }} @else - @endif</div>
                </div>
    
                <div class="row">
                    <div class="col-lg-3 col-md-4 label text-muted">Gender</div>
                    <div class="col-lg-9 col-md-8">@if($dosen[0]->gender) {{ Str::ucfirst($dosen[0]->gender) }} @else - @endif</div>
                </div>
                
                <div class="row">
                    <div class="col-lg-3 col-md-4 label text-muted">Role</div>
                    <div class="col-lg-9 col-md-8 text-capitalize">
                        @if($dosen[0]->role) {{ Str::ucfirst($dosen[0]->role) }} @else - @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label text-muted">Created At</div>
                    <div class="col-lg-9 col-md-8">{{ $created_at }}</div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label text-muted">Last Updated</div>
                    <div class="col-lg-9 col-md-8">{{ $dosen[0]->updated_at->diffForHumans() }}</div>
                </div>
    
                <div class="text-center mt-5">
                    <button class="btn btn-danger" id="recycle-btn" value="{{ $dosen[0]->slug }}"><i class="bi bi-trash3"></i> Delete</button>
                    <button class="btn btn-warning" id="archive-btn" value="{{ $dosen[0]->slug }}"><i class="bi bi-archive"></i> Archive</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).on('click', '#recycle-btn', function () {
            let slug = $(this).val();
            
            $.post(`/dosen/`+slug+`/recycle`, {
                '_token': '{{ csrf_token() }}',
                '_method': 'put'
            })
            .done(response => {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Dosen Moved to recycle!',
                    showConfirmButton: false,
                    timer: 2000
                });
                window.setTimeout(function(){
                    window.location.href = "{{ url('/dosen') }}";
                }, 2000);
                return;
            })
            .fail(errors => {
                return;
            })
        });

        $(document).on('click', '#archive-btn', function () {
            let slug = $(this).val();
            
            $.post(`/dosen/`+slug+`/archive`, {
                '_token': '{{ csrf_token() }}',
                '_method': 'put'
            })
            .done(response => {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Dosen Moved to Archive!',
                    showConfirmButton: false,
                    timer: 2000
                });
                window.setTimeout(function(){
                    window.location.href = "{{ url('/dosen') }}";
                }, 2000);
                return;
            })
            .fail(errors => {
                return;
            })
        });
    </script>
@endpush
@endsection