@extends('layouts.main')

@section('section')
    @if (auth()->user()->level == 'mahasiswa')
        @include('mahasiswa/history')
    @elseif (auth()->user()->level == 'dosen')
        @include('dosen/history')
    @else
        @include('superadmin/history')
    @endif
@endsection