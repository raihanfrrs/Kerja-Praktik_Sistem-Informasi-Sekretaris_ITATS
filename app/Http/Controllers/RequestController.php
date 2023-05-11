<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function request_index()
    {
        if (auth()->user()->level === 'mahasiswa') {
            return view('mahasiswa.request.index')->with([
                'title' => 'Permintaan',
                'subtitle' => 'Permintaan'
            ]);
        }elseif (auth()->user()->level === 'dosen') {
            return view('dosen.request.index')->with([
                'title' => 'Permintaan',
                'subtitle' => 'Permintaan'
            ]);
        }
    }
}
