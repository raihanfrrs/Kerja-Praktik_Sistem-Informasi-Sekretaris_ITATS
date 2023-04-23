@extends('layouts.main')

@section('section')
<div class="card overflow-auto mx-2">
    <div class="filter">
        <a href="{{ url('mahasiswa/add') }}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Mahasiswa"><i class="bi bi-person-plus"></i></a>
    </div>

    <div class="card-body">
        <h5 class="card-title">Mahasiswa <span>| Data Master</span></h5>
        <div class="table-responsive">
            <table class="table table-master table-borderless datatable table-hover" id="dataMahasiswa">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Mahasiswa</th>
                        <th scope="col" class="text-center">NPM</th>
                        <th scope="col" class="text-center">Email</th>
                        <th scope="col" class="text-center">Nomor HP</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection