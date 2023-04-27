@extends('layouts.main')

@section('section')

@include('superadmin.master.role.role-modal')

<div class="card overflow-auto mx-2">
    <div class="filter">
        <a href="{{ url('/role/add') }}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Jabatan"><i class="bi bi-journal-plus"></i></a>
    </div>

    <div class="card-body">
    <h5 class="card-title">Role <span>| Data Master</span></h5>
        <div class="table-responsive">
            <table id="dataRole" class="table table-master table-borderless datatable table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Jabatan</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection