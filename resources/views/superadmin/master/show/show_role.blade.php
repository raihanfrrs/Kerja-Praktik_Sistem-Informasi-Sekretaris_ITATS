@extends('layouts.main')

@section('section')
<div class="col-lg-12">
    <div class="row">

        <div class="col-12">
        <div class="card master-dosen overflow-auto">
            <div class="filter">
                <a href="{{ url('master/role/create') }}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Add Dosen"><i class="bi bi-person-plus"></i></a>
            </div>

            <div class="card-body">
            <h5 class="card-title">Role <span>| {{ $subtitle }}</span></h5>
            <table class="table table-master table-borderless datatable table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Dosen</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($roles as $item)
                    <tr>
                        <th scope="row">#{{ $loop->iteration }}</th>
                        <td>{{ $item->dosen->name }}</td>
                        <td>
                            <form action="/master/detail-role/{{ $item->id }}" method="post" class='d-inline'>
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