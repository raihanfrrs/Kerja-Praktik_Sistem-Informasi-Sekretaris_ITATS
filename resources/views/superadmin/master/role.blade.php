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
            <h5 class="card-title">Dosen <span>| Data Master</span></h5>
            <table class="table table-master table-borderless datatable table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($role as $list)
                <tr>
                    <th scope="row">#{{ $loop->iteration }}</th>
                    <td><a href="role/{{ $list->slug }}" class="text-primary">{{ $list->role }}</a></td>
                    <td>
                        <a href="role/{{ $list->slug }}/edit" class="btn btn-warning" ><i class="bi bi-pen"></i></a>
                        <form action="role/{{ $list->id }}" method="post" class='d-inline'>
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