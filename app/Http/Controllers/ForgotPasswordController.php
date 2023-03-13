<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Otp;
use App\Models\User;
use App\Models\Dosen;
use App\Mail\SendEmail;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;

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

        if (Otp::where('user_id', $user->user_id)->count() == 0) {
            return redirect('login')->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'error',
                'message' => 'OTP Expired !'
            ]);
        }

        if (Hash::check($request->otp, $otp->otp)) {
            $request->session()->put('session_user', [
                'user' => $user->slug,
                'expiration' => now()->addMinutes(2)
            ]);

            return redirect('reset-password');
        }
    }

    public function resetPassword(Request $request)
    {
        if (Carbon::now() < $request->session()->get('session_user')['expiration']) {
            return view('forgot-password.view_password_reset')->with([
                'user' => Session::get('user')
            ]);
        } else {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'error',
                'message' => 'OTP Expired !'
            ]);
        }
    }

    public function renewPassword(Request $request)
    {
        $validateData = $request->validate([
            'email' => 'required|min:5|max:255|unique:dosens|email:dns',
            'otp' => 'required|min:6|max:6',
            'password' => ['required', Password::min(5)->mixedCase()->letters()->numbers()->symbols()->uncompromised()]
        ]);

        $mahasiswas = Mahasiswa::where('email', $request->email);
        $dosens = Dosen::where('email', $request->email);

        if ($mahasiswas->count() > 0) {
            $user = $mahasiswas->first();
        }elseif ($dosens->count() > 0) {
            $user = $dosens->first();
        }

        User::whereId($user->user_id)->update(['password' => Hash::make($request->password)]);

        return back()->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Password Updated!'
        ]);
    }
}