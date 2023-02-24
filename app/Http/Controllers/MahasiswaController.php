<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class MahasiswaController extends Controller
{
    public function request_index()
    {
        return view('mahasiswa.request.index');
    }

    public function accept_index()
    {

    }
}
