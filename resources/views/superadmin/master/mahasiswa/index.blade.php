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
            <table class="table table-master table-borderless datatable table-hover">
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
                <tbody>
                @foreach ($mahasiswas as $mahasiswa)
                <tr>
                    <th scope="row">#{{ $loop->iteration }}</th>
                    <td>{{ $mahasiswa->name }}</td>
                    <td><a href="mahasiswa/{{ $mahasiswa->slug }}" class="text-primary">{{ $mahasiswa->npm }}</a></td>
                    <td>{{ $mahasiswa->email }}</td>
                    <td>{{ $mahasiswa->phone }}</td>
                    <td><span class="badge bg-{{ $mahasiswa->status > 0 ? 'success' : 'danger'}}">{{ $mahasiswa->status > 0 ? 'approved' : 'disapprove'}}</span></td>
                    <td>
                        <form action="/mahasiswa/{{ $mahasiswa->slug }}" class="d-inline" method="post">
                            @method('put')
                            @csrf
                            <button name="status" value="checked" class="btn btn-sm btn-{{ $mahasiswa->status > 0 ? 'danger' : 'success' }}" ><i class="{{ $mahasiswa->status > 0 ? 'bi bi-x-circle' : 'bi bi-check-circle' }}"></i></button>
                        </form>

                        <a href="/mahasiswa/{{ $mahasiswa->slug }}/edit" class="btn btn-sm btn-warning" ><i class="bi bi-pen"></i></a>
                        <form action="/mahasiswa/{{ $mahasiswa->slug }}" method="post" class='d-inline'>
                            @method('delete')
                            @csrf
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>

            </div>

        </div>
        </div>

    </div>
</div>
@endsection