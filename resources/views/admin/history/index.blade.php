@extends('layouts.main')

@section('section')
<div class="card overflow-auto mx-2">

    <div class="card-body">
    <h5 class="card-title">Riwayat <span>| Permintaan</span></h5>
    <div class="table-responsive">
        <table class="table table-master table-borderless datatable table-hover" id="dataAssignHistory">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Nama Lengkap</th>
                    <th scope="col" class="text-center">Tingkatan</th>
                    <th scope="col" class="text-center">Permintaan Dibuat</th>
                    <th scope="col" class="text-center">Status</th>
                    <th scope="col" class="text-center">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
    </div>
</div>
@endsection