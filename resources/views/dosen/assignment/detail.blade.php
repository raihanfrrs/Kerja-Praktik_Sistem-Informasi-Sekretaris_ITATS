@extends('layouts.main')

@section('section')
<div class="card">
    <div class="card-body">

      <h5 class="card-title">Default</h5>

      <form action="/assignment/{{ $request->id }}" method="post">
        @foreach ($detail_requests as $detail_request)
          <div class="row py-5">
            <div class="col-5">
                {{ $detail_request->name }}
            </div>
            <div class="col-7">
                <input type="file" name="file" id="file">
            </div>
          </div>
        @endforeach
      </form>

    </div>
</div>
@endsection