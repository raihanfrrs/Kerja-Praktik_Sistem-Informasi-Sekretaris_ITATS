@extends('layouts.main')

@section('section')
<div class="card overflow-auto mx-2">
    <div class="filter">
        <a href="{{ url('/category/add') }}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Add Surat"><i class="bi bi-envelope-plus"></i></a>
    </div>

    <div class="card-body">
    <h5 class="card-title">Category <span>| Data Master</span></h5>
        <div class="table-responsive">
            <table id="dataCategory" class="table table-borderless datatable">
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
@endsection