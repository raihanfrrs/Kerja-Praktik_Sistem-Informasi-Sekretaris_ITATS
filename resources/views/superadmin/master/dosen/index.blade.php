@extends('layouts.main')

@section('section')
<div class="card overflow-auto mx-2">
    <div class="filter">
        <a href="{{ url('/dosen/add') }}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Add Dosen"><i class="bi bi-person-plus"></i></a>
    </div>

    <div class="card-body">
    <h5 class="card-title">Dosen <span>| Data Master</span></h5>
    <table id="dataDosen" class="table table-master table-borderless datatable table-hover">
        <thead>
            <tr>
                <th scope="col" class="text-center">Dosen</th>
                <th scope="col" class="text-center">NIP</th>
                <th scope="col" class="text-center">Email</th>
                <th scope="col" class="text-center">Phone</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
    </table>
    </div>
</div>
@endsection