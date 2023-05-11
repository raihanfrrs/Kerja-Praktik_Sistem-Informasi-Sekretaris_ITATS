@extends('layouts.main')

@section('section')
<div class="card overflow-auto mx-2">
    <div class="filter">
        <a href="{{ url('/surat/add') }}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Surat"><i class="bi bi-envelope-plus"></i></a>
    </div>

    <div class="card-body">
    <h5 class="card-title">Surat <span>| Data Master</span></h5>
        <div class="table-responsive">
            <table id="dataSurat" class="table table-borderless datatable">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Surat</th>
                        <th scope="col" class="text-center">Jenis Surat</th>
                        <th scope="col" class="text-center">Deskripsi</th>
                        <th scope="col" class="text-center">Level</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection