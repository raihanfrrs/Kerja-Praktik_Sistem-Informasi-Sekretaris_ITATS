<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->level == 'mahasiswa'){
            $data = Mahasiswa::where('user_id', auth()->user()->id)->get();
        }else{
            $data = Dosen::where('user_id', auth()->user()->id)->get();
        }

        return view('profile')->with([
            'user' => $data
        ]);
    }

    public function update(Request $request, mahasiswa $mahasiswa, dosen $dosen)
    {
        $rules = [
            'name' => 'required|max:225|min:3|regex:/^[\pL\s\-]+$/u',
            'birthPlace' => 'required|max:225|min:3',
            'birthDate' => 'required',
            'gender' => 'required',
            'image' => 'image|file|max:2048'
        ];

        if(auth()->user()->level == 'mahasiswa'){
            if($request->npm != $mahasiswa->npm){
                $rules['npm'] = 'required|numeric|unique:mahasiswas';
            }
            if($request->email != $mahasiswa->email){
                $rules['email'] = 'required|email:dns|max:255|unique:mahasiswas';
            }
            if($request->phone != $mahasiswa->phone){
                $rules['phone'] = 'required|numeric|unique:mahasiswas';
            }
        }else{
            if($request->nip != $dosen->nip){
                $rules['nip'] = 'required|numeric|unique:dosens';
            }
            if($request->email != $dosen->email){
                $rules['email'] = 'required|email:dns|max:255|unique:dosens';
            }
            if($request->phone != $dosen->phone){
                $rules['phone'] = 'required|numeric|unique:dosens';
            }
        }

        $validateData = $request->validate($rules);

        if(auth()->user()->level == 'mahasiswa'){

            if ($request->file('image')) {
                if ($mahasiswa->image) {
                    Storage::delete($mahasiswa->image);
                }
                $validateData['image'] = $request->file('image')->store('profile-image');
            }
            
            Mahasiswa::where('user_id', auth()->user()->id)
                        ->update($validateData);
            
            return redirect('profile')->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Profile Updated!'
            ]);
        }else{
            if ($request->file('image')) {
                if ($dosen->image) {
                    Storage::delete($dosen->image);
                }
                $validateData['image'] = $request->file('image')->store('profile-image');
            }

            Dosen::where('user_id', auth()->user()->id)
                        ->update($validateData);
            
            return redirect('/profile')->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Profile Updated!'
            ]);
        }
    }

    public function updatePassword(Request $request){
        $request->validate([
            'oldPassword' => 'required',
            'password' => ['required', Password::min(5)->mixedCase()->letters()->numbers()->symbols()->uncompromised()]
        ]);

        if(!Hash::check($request->oldPassword, auth()->user()->password)){
            return back()->with([
                'case' => 'default',
                'type' => 'danger',
                'message' => "Old Password Doesn't match!"
            ]);
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Password Updated!'
        ]);
    }
}
