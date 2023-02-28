@extends('layouts.main')

@section('section')
<div class="card overflow-auto mx-2">

    <div class="card-body">
    <h5 class="card-title">History <span>| Request</span></h5>
    <div class="table-responsive">
        <table class="table table-master table-borderless datatable table-hover" id="dataRequestHistory">
            <thead>
                <tr>
                    <th scope="col" class="text-center">#ID</th>
                    <th scope="col" class="text-center">Amount</th>
                    <th scope="col" class="text-center">Date</th>
                    <th scope="col" class="text-center">Status</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
            </thead>
        </table>
    </div>
    </div>
</div>
@endsection