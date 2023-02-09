@extends('layouts.main')

@section('section')
<div class="col-lg-12">
    <div class="row">
        <div class="col-12">
            <div class="card master-mahasiswa overflow-auto">
                <div class="filter">
                    <a href="{{ url('mahasiswa/add') }}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Add Mahasiswa"><i class="bi bi-person-plus"></i></a>
                </div>

                <div class="card-body">
                <h5 class="card-title">Mahasiswa <span>| Data Master</span></h5>
                <table class="table table-master table-borderless datatable table-hover" id="dataMahasiswa">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Mahasiswa</th>
                            <th scope="col">NPM</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection