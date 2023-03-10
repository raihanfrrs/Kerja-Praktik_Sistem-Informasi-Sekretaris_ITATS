<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class LayoutController extends Controller
{
    public function index()
    {
        session(['deactivate' => Mahasiswa::where('status', 'deactivated')->count() + Dosen::where('status', 'deactivated')->count()]);

        return view('welcome');
    }
}