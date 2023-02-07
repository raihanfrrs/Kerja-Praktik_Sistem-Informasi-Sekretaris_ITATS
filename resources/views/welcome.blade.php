@extends('layouts.main')

@section('section')
    @if (auth()->user()->level == 'mahasiswa')
        @include('mahasiswa.dashboard')
    @elseif (auth()->user()->level == 'dosen')
        @include('dosen.dashboard')
    @else
        @include('superadmin.dashboard')
    @endif
@endsection