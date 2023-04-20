<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        if(Auth::user()){
            return redirect()->intended('dashboard');
        }

        return view('login.view_login');
    }

    public function proses(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $kredensial = $request->only('username', 'password');

        $checkUser = User::where('username', $request->username)->first();

        
        if (empty($checkUser)) {
            return back()->withErrors([
                'username' => 'Username atau Kata Sandi Salah'
            ])->onlyInput('username');
        }

        if ($checkUser->count() > 0) {
            if (Mahasiswa::where('user_id', $checkUser->id)->count() > 0) {
                if ($checkUser->mahasiswa->status === 'deactivated') {
                    return back()->withErrors([
                        'username' => 'Akun anda sedang dinonaktifkan oleh admin, silakan hubungi admin!',
                    ])->onlyInput('username');
                }elseif($checkUser->mahasiswa->status === 'disapprove') {
                    return back()->withErrors([
                        'username' => 'Akun anda sedang dinonaktifkan oleh admin, silakan hubungi admin!',
                    ])->onlyInput('username');
                }
            }elseif (Dosen::where('user_id', $checkUser->id)->count() > 0) {
                if ($checkUser->dosen->status === 'deactivated') {
                    return back()->withErrors([
                        'username' => 'Akun anda sedang dinonaktifkan oleh admin, silakan hubungi admin!',
                    ])->onlyInput('username');
                };
            }
        }

        if(Auth::attempt($kredensial)){
            $request->session()->regenerate();

            $user = Auth::user();

            if($user){
                return redirect()->intended('/')->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Berhasil Masuk Ke Sistem!'
                ]);
            }

            return redirect()->intended('/');
        }
        
        return back()->withErrors([
            'username' => 'Username or Kata Sandi Salah'
        ])->onlyInput('username');
    }

    public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}