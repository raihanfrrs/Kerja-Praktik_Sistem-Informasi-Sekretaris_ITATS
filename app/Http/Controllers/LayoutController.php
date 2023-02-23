<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Dosen;
use App\Models\JenisSurat;
use App\Models\Mahasiswa;

class LayoutController extends Controller
{
    public function index()
    {
        session(['deactivate' => Mahasiswa::where('status', 'deactivated')->count() 
                                + Dosen::where('status', 'deactivated')->count() 
                                + Role::where('status', 'deactivated')->count() 
                                + JenisSurat::where('status', 'deactivated')->count()]);

        return view('welcome');
    }
}