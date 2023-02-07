<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperadminController extends Controller
{
    public function surat()
    {
        return view('superadmin.master.surat');
    }

    public function createMahasiswa()
    {
        return view('superadmin.master.create.create_mahasiswa');
    }
}