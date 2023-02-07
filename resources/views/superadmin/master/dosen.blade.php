@extends('layouts.main')

@section('section')
<div class="col-lg-12">
    <div class="row">

        <div class="col-12">
        <div class="card master-dosen overflow-auto">
            <div class="filter">
                <a href="{{ url('master/dosen/create') }}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Add Dosen"><i class="bi bi-person-plus"></i></a>
            </div>

            <div class="card-body">
            <h5 class="card-title">Dosen <span>| Data Master</span></h5>
            <table class="table table-master table-borderless datatable table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Dosen</th>
                    <th scope="col">NIP</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($dosen as $list)
                <tr>
                    <th scope="row">#{{ $loop->iteration }}</th>
                    <td>{{ $list->name }}</td>
                    <td><a href="dosen/{{ $list->nip }}" class="text-primary">{{ $list->nip }}</a></td>
                    <td>{{ $list->email }}</td>
                    <td>{{ $list->phone }}</td>
                    <td>
                        <a href="dosen/{{ $list->nip }}/edit" class="btn btn-warning" ><i class="bi bi-pen"></i></a>
                        <form action="dosen/{{ $list->user_id }}" method="post" class='d-inline'>
                            @method('delete')
                            @csrf
                            <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></button>
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