@extends('layouts.main')

@section('section')
<div class="col-lg-12">
    <div class="row">

        <div class="col-12">
        <div class="card master-dosen overflow-auto">
            <div class="filter">
                <a href="{{ url('/dosen/add') }}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Add Dosen"><i class="bi bi-person-plus"></i></a>
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
                @foreach ($dosens as $dosen)
                <tr>
                    <th scope="row">#{{ $loop->iteration }}</th>
                    <td>{{ $dosen->name }}</td>
                    <td><a href="/dosen/{{ $dosen->slug }}" class="text-primary">{{ $dosen->nip }}</a></td>
                    <td>{{ $dosen->email }}</td>
                    <td>{{ $dosen->phone }}</td>
                    <td>
                        <a href="/dosen/{{ $dosen->slug }}/edit" class="btn btn-warning" ><i class="bi bi-pen"></i></a>
                        <form action="dosen/{{ $dosen->slug }}" method="post" class='d-inline'>
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