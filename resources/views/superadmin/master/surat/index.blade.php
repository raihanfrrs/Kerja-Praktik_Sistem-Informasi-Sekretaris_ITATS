@extends('layouts.main')

@section('section')

@include('superadmin.master.surat.surat-modal')

<div class="col-lg-12">
    <div class="row">
        <div class="col-12">
            <div class="card overflow-auto">

                <div class="card-body">
                <h5 class="card-title">Surat <span>| Data Master</span></h5>
                    <div class="table-responsive">
                        <table id="dataJenisSurat" class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th scope="col">Jenis Surat</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).on('click', '#detail-surat-button', function () {
            let slug = $(this).val();

            $.post(`{{ url('surat') }}/`+slug, {
                '_token': '{{ csrf_token() }}',
                '_method': 'get'
            })
            .done(response => {
                $("#modal-surat").html(response);
                $("#detail-surat").modal('show');
            })
            .fail(errors => {
                return;
            })
        });

        $(document).on('click', '#modal-dismiss', function () {
            $('#detail-surat').modal('hide');
        });
    </script>
@endpush
@endsection