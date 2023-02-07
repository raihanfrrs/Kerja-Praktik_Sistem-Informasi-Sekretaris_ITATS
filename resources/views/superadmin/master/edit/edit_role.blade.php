@extends('layouts.main')

@section('section')
@foreach($role as $list)
<div class="card">
    <div class="card-body">
      <h5 class="card-title">Role <span>| Edit</span></h5>

      <!-- Horizontal Form -->
      <form action="/master/role/{{ $list->id }}" method="post">
        @method('put')
        @csrf
        <div class="row mb-3">
          <label for="role" class="col-sm-2 col-form-label">Role</label>
          <div class="col-sm-10">
            <input type="text" class="form-control @error('role') is-invalid @enderror" id="role" name="role" required value="{{ old('role', $list->role) }}">
            @error('role') <div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
          <a href="{{ url('master/role') }}" class="btn btn-danger">Back</a>
        </div>
      </form><!-- End Horizontal Form -->

    </div>
</div>
@endforeach
@endsection