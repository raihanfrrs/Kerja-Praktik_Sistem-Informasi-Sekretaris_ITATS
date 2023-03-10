<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('register.view_register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateDataMahasiswa = $request->validate([
            'username' => 'required|min:5|max:255|unique:users|alpha_num',
            'password' => ['required', Password::min(5)->mixedCase()->letters()->numbers()->symbols()->uncompromised()],
            'name' => 'required|min:3|max:255|regex:/^[\pL\s\-]+$/u',
            'npm' => 'required|numeric|unique:mahasiswas',
            'email' => 'required|min:5|max:255|unique:mahasiswas|email:dns',
            'phone' =>'required|numeric|unique:mahasiswas'
        ]);

        $validateDataMahasiswa['level'] = 'mahasiswa';
        $validateDataMahasiswa['password'] = bcrypt($validateDataMahasiswa['password']);

        $user = User::create($validateDataMahasiswa);

        $validateDataMahasiswa['user_id'] = $user->id;

        Mahasiswa::create($validateDataMahasiswa);

        return redirect('login')->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Register Successfully!'
        ]);
    }
}