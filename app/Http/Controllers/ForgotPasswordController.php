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
    
    public function index()
    {
        if(Auth::user()){
            return redirect()->intended('dashboard');
        }

        return view('forgot-password.view-request-reset');
    }

    public function getEmail(Request $request)
    {
        $dataMahasiswas = collect(Mahasiswa::all());
        $dataDosens = collect(Dosen::all());

        $datas = $dataMahasiswas->merge($dataDosens);
        $this->Email = $request->Email;

        $datas = collect($datas->filter(function ($value) {
            return $value['email'] == $this->Email;
        })) ;

        return $datas->first();
    }

    public function sendCode(Request $request)
    {
        $kode_otp = random_int(100000,999999);
        Mail::to($request->Email)->send(new SendEmail($kode_otp));

        return $kode_otp;
    }

    public function RenewPassword(Request $request)
    {
       if(User::where('id', $request->user_id)->update(['password' => bcrypt($request->renew_password)]) == 1){

           return redirect('/login')->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Password Berhasil di perbarui!'
        ]);
        
       }
    }
}
