@extends('layouts.main')

@section('section')
<form action="/assignment" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" id="file" data-id="1">
    <input type="submit" value="Submit">
</form>
@endsection