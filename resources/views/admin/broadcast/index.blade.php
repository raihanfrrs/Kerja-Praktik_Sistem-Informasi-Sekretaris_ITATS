@extends('layouts.main')

@section('section')

@include('admin.broadcast.dosen-modal')

<div class="card overflow-auto mx-2">

    <div class="card-body">
    <h5 class="card-title">Penyiaran <span>| Surat</span></h5>
        <div class="row">
            <div class="col-12">
                <input type="file" name="files" id="files" multiple>
            </div>
            <div class="d-grid gap-2 mt-3">
                <button class="btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#listDosenModal"><i class="bi bi-list-columns"></i> List Dosen</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card overflow-auto">

            <div class="card-body">
            <h5 class="card-title">Menunggu <span id="btn-reset-surat-wait" class="float-end"></span></h5>
                <div id="data-broadcast"></div>
                <div id="btn-send-broadcast"></div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card overflow-auto">

            <div class="card-body">
            <h5 class="card-title">Dosen <span id="btn-reset-dosen-wait" class="float-end"></span></h5>
                <div id="data-listDosen"></div>
            </div>
        </div>
    </div>
</div>
@endsection