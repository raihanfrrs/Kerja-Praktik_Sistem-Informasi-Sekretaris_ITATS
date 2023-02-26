<?php

namespace App\Http\Controllers;

use App\Models\Role;
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
                                + Role::where('status', 'deactivated')->count() 
                                + JenisSurat::where('status', 'deactivated')->count()]);
        } elseif (auth()->user()->level === 'mahasiswa') {
            session(['request' => TempRequest::where('mahasiswa_id', auth()->user()->mahasiswa->id)->count()]);
        }

        return view('welcome');
    }
}