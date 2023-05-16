<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\JenisSurat;
use App\Models\Mahasiswa;
use App\Models\TempRequest;

class LayoutController extends Controller
{

    public function index()
    {
        if (auth()->user()->level === 'superadmin') {
            session(['deactivate' => Mahasiswa::where('status', 'deactivated')->count() 
                                + Dosen::where('status', 'deactivated')->count() 
                                + JenisSurat::where('status', 'deactivated')->count()]);
        } elseif (auth()->user()->level === 'mahasiswa' || auth()->user()->level === 'dosen') {
            session(['request' => TempRequest::where('user_id', auth()->user()->id)->count()]);
        }

        return view('welcome')->with([
            'subtitle' => 'Halaman Utama'
        ]);
    }
    
}