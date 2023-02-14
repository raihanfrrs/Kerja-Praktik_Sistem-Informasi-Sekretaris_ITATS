<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class LayoutController extends Controller
{
    public function index()
    {

        $recycle = Mahasiswa::where('status', 'recycle')->count() + Dosen::where('status', 'recycle')->count();
        $archive = Mahasiswa::where('status', 'archive')->count() + Dosen::where('status', 'archive')->count();

        session(['recycle' => $recycle, 'archive' => $archive]);

        return view('welcome');
    }
}