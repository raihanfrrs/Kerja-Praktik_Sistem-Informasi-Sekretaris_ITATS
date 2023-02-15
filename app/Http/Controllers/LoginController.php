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

        $checkUser = User::where('username', $request->username)->get();

        if ($checkUser->count() > 0) {
            if (Mahasiswa::where('user_id', $checkUser[0]->id)->count() > 0) {
                if ($checkUser[0]->mahasiswa->status === 'deactivated') {
                    return back()->withErrors([
                        'username' => 'Your account is being deactivated by the admin, please contact the admin!',
                    ])->onlyInput('username');
                }
            }elseif (Dosen::where('user_id', $checkUser[0]->id)->count() > 0) {
                if ($checkUser[0]->dosen->status === 'deactivated') {
                    return back()->withErrors([
                        'username' => 'Your account is being deactivated by the admin, please contact the admin!',
                    ])->onlyInput('username');
                }
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
                    'message' => 'Login Successfully!'
                ]);
            }

            return redirect()->intended('/');
        }
        
        return back()->withErrors([
            'username' => 'Username or Password Wrong'
        ])->onlyInput('username');
    }

    public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}