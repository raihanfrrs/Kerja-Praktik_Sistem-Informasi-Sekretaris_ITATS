<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class RecycleController extends Controller
{
    public function index()
    {
        return view('superadmin.recycle.index')->with([
            'mahasiswas' => Mahasiswa::where('status', 'recycle')->get()
        ]);
    }
}
