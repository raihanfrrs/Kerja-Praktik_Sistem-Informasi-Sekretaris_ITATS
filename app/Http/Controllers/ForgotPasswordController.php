<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Otp;
use App\Models\Dosen;
use App\Mail\SendEmail;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    private $email = "";
    
    public function index()
    {
        if(Auth::user()){
            return redirect()->intended('dashboard');
        }

        return view('forgot-password.view_request_reset');
    }

    public function getEmail(Request $request)
    {
        $dataMahasiswas = collect(Mahasiswa::all());
        $dataDosens = collect(Dosen::all());

        $datas = $dataMahasiswas->merge($dataDosens);
        $this->email = $request->email;

        $datas = collect($datas->filter(function ($value) {
            return $value['email'] == $this->email;
        })) ;

        return $datas->first();
    }

    public function sendCode(Request $request)
    {
        $kode_otp = random_int(100000,999999);
        Mail::to($request->email)->send(new SendEmail($kode_otp));

        $mahasiswas = Mahasiswa::where('email', $request->email);
        $dosens = Dosen::where('email', $request->email);

        if ($mahasiswas->count() > 0) {
            $user = $mahasiswas->first();
        }elseif ($dosens->count() > 0) {
            $user = $dosens->first();
        }

        if (Otp::where('user_id', $user->user_id)->count() > 0) {
            Otp::where('user_id', $user->user_id)->delete();
        }

        Otp::insert([
            'user_id' => $user->user_id,
            'otp' => Hash::make($kode_otp),
            'expiration_time' => Carbon::now()
        ]);
    }

    public function checkOtp(Request $request)
    {
        $mahasiswas = Mahasiswa::where('email', $request->email);
        $dosens = Dosen::where('email', $request->email);

        if ($mahasiswas->count() > 0) {
            $user = $mahasiswas->first();
        }elseif ($dosens->count() > 0) {
            $user = $dosens->first();
        }

        $otp = Otp::where('user_id', $user->user_id)->first();

        $data = [
            'form' => Hash::make($request->otp),
            'database' => $otp->otp
        ];

        return $data;
    }

    // public function RenewPassword(Request $request)
    // {
    //     dd($this->kode);
    //     if ($request->otp == $this->kode) {
    //         if(User::where('id', $request->user_id)->update(['password' => bcrypt($request->renew_password)]) == 1){

    //             return redirect('/login')->with([
    //              'flash-type' => 'sweetalert',
    //              'case' => 'default',
    //              'position' => 'center',
    //              'type' => 'success',
    //              'message' => 'Password Berhasil di perbarui!'
    //          ]);
    //         }
    //     }else {
    //         return redirect('/lupa-password')->with([
    //             'flash-type' => 'sweetalert',
    //             'case' => 'default',
    //             'position' => 'center',
    //             'type' => 'error',
    //             'message' => 'Kode OTP yang anda masukan salah!'
    //         ]);
    //     }
    // }
}