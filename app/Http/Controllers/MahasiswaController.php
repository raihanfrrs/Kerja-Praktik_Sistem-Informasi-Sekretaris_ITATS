<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('superadmin.master.mahasiswa')->with([
            'mahasiswa' => Mahasiswa::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin.master.create.create_mahasiswa')->with([
            'title' => 'Mahasiswa'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'username' => 'required|min:5|max:255|unique:users|alpha_num',
            'password' => ['required', Password::min(5)->mixedCase()->letters()->numbers()->symbols()->uncompromised()],
            'name' => 'required|min:3|max:255|regex:/^[\pL\s\-]+$/u',
            'npm' => 'required|numeric|unique:mahasiswas',
            'email' => 'required|min:5|max:255|unique:mahasiswas|email:dns',
            'phone' =>'required|numeric|unique:mahasiswas',
            'birthPlace' => 'required|max:225|min:3',
            'birthDate' => 'required',
            'gender' => 'required'
        ]);

        $validateData['level'] = 'mahasiswa';
        $validateData['password'] = bcrypt($validateData['password']);

        $user = User::create($validateData);

        $validateData['user_id'] = $user->id;

        Mahasiswa::create($validateData);

        $status['status'] = $request->status;
        Mahasiswa::where('user_id', $user->id)
                    ->update($status);

        return redirect('master/mahasiswa')->with([
            'case' => 'default',
            'type' => 'success',
            'message' => 'Add Mahasiswa successfull!.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('superadmin.master.show.show_mahasiswa')->with([
            'mahasiswa' => Mahasiswa::where('npm', $id)->get(),
            'title' => 'Mahasiswa',
            'subtitle' => 'Details'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('superadmin.master.edit.edit_mahasiswa')->with([
            'title' => 'Mahasiswa',
            'mahasiswa' => Mahasiswa::where('npm', $id)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        if($request->status == '1' || $request->status == '0'){
            $validateData['status'] = $request->status;
            Mahasiswa::where('npm', $mahasiswa->npm)
                    ->update($validateData);

            return redirect('master/mahasiswa');
        }

        $rules = [
            'name' => 'required|max:225|min:3|regex:/^[\pL\s\-]+$/u',
            'birthPlace' => 'required|max:225|min:3',
            'birthDate' => 'required',
            'gender' => 'required'
        ];

        if($request->npm != $mahasiswa->npm){
            $rules['npm'] = 'required|numeric|unique:mahasiswas';
        }
        if($request->email != $mahasiswa->email){
            $rules['email'] = 'required|email:dns|max:255|unique:mahasiswas';
        }
        if($request->phone != $mahasiswa->phone){
            $rules['phone'] = 'required|numeric|unique:mahasiswas';
        }

        $validateData = $request->validate($rules);
            
        Mahasiswa::where('id', $mahasiswa->id)
                    ->update($validateData);
        
        return redirect('master/mahasiswa')->with([
            'case' => 'default',
            'type' => 'success',
            'message' => 'Edit Mahasiswa Successfull!.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Mahasiswa::where('user_id', $id)->delete();
        User::destroy($id);

        return redirect('master/mahasiswa')->with([
            'case' => 'default',
            'type' => 'success',
            'message' => 'Delete Mahasiswa Successfull!.'
        ]);;
    }
}
