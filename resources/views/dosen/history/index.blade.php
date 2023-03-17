@extends('layouts.main')

@section('section')
<div class="card overflow-auto mx-2">

    <div class="card-body">
    <h5 class="card-title">History <span>| Assignment</span></h5>
    <div class="table-responsive">
        <table class="table table-master table-borderless datatable table-hover" id="dataAssignHistory">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Mahasiswa</th>
                    <th scope="col" class="text-center">Requested At</th>
                    <th scope="col" class="text-center">Status</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
            </thead>
        </table>
    </div>
    </div>
</div>
@endsection