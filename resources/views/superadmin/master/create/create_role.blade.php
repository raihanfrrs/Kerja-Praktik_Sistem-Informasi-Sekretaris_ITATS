@extends('layouts.main')

@section('section')
<div class="card">
    <div class="card-body">
      <h5 class="card-title">Role <span>| Add</span></h5>

      <!-- Horizontal Form -->
      <form action="{{ url('/master/role') }}" method="post">
        @csrf
        <div class="row mb-3">
          <label for="role" class="col-sm-2 col-form-label">Role</label>
          <div class="col-sm-10">
            <input type="text" class="form-control @error('role') is-invalid @enderror" id="role" name="role" required value="{{ old('role') }}">
            @error('role') <div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
      </form><!-- End Horizontal Form -->

    </div>
</div>
@endsection