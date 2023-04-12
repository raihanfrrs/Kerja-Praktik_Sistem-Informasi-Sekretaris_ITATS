@extends('layouts.main')

@section('section')
    @if (auth()->user()->level == 'mahasiswa')
        @include('mahasiswa.dashboard.index')
    @elseif (auth()->user()->level == 'dosen')
        @include('dosen.dashboard.index')
    @else
        @include('superadmin.dashboard')
    @endif
@endsection