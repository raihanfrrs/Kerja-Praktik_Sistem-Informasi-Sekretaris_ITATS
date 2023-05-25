@extends('layouts.main')

@section('section')
<div class="card overflow-auto mx-2">

    <div class="card-body">
    <h5 class="card-title">Siaran <span>| Surat</span></h5>
    <div class="table-responsive">
        <table class="table table-master table-borderless datatable table-hover" id="dataBroadcastList">
            <thead>
                <tr>
                    <th scope="col" class="text-center">ID</th>
                    <th scope="col" class="text-center">Siaran Dibuat</th>
                    <th scope="col" class="text-center">Jumlah</th>
                    <th scope="col" class="text-center">Pengirim</th>
                    <th scope="col" class="text-center">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
    </div>
</div>
@endsection