<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Models\Dosen;

class ForgotPasswordController extends Controller
{
    private $Email = "";
    private $kode = "";
    //
    public function index(){
        if(Auth::user()){
            return redirect()->intended('dashboard');
        }

        return view('forgot_password.view_request_reset');
    }

    public function getEmail(Request $req){
        $data = collect(Mahasiswa::all());
        $data2 = collect(Dosen::all());
        $data = $data->merge($data2);
        $this->Email = $req->Email;
        $data = collect($data->filter(function ($value) {
            return $value['email'] == $this->Email;
        })) ;
        return $data->first();
        
    }

    public function sendCode(Request $req){
        $kode_otp = random_int(100000,999999);
        Mail::to($req->Email)->send(new SendEmail($kode_otp));
        $this->kode = $kode_otp;
    }

    public function RenewPassword(Request $req){
        if ($req->otp == $this->kode) {
            if(User::where('id', $req->user_id)->update(['password' => bcrypt($req->renew_password)]) == 1){
             
                return redirect('/login')->with([
                 'flash-type' => 'sweetalert',
                 'case' => 'default',
                 'position' => 'center',
                 'type' => 'success',
                 'message' => 'Password Berhasil di perbarui!'
             ]);
            }
        }else {
            return redirect('/lupa-password')->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'error',
                'message' => 'Kode OTP yang anda masukan salah!'
            ]);
        }
    }
}
