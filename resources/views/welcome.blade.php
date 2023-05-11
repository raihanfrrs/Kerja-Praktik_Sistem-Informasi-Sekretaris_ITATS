@extends('layouts.main')

@section('section')
    @if (auth()->user()->level == 'mahasiswa')
        @include('mahasiswa.dashboard.index')
    @elseif (auth()->user()->level == 'dosen')
        @include('dosen.dashboard.index')
    @elseif (auth()->user()->level == 'admin')
        @include('admin.dashboard.index')
    @else
        @include('superadmin.dashboard.index')
    @endif
@endsection