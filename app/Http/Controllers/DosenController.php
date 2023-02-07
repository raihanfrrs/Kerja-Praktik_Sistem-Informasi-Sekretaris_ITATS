<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('superadmin.master.dosen')->with([
            'dosen' => Dosen::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin.master.create.create_dosen')->with([
            'title' => 'Dosen'
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
            'nip' => 'required|numeric|unique:dosens',
            'email' => 'required|min:5|max:255|unique:mahasiswas|email:dns',
            'phone' =>'required|numeric|unique:dosens',
            'birthPlace' => 'required|max:225|min:3',
            'birthDate' => 'required',
            'gender' => 'required',
            'role' => 'required' 
        ]);

        $validateData['level'] = 'dosen';
        $validateData['password'] = bcrypt($validateData['password']);

        $user = User::create($validateData);

        $validateData['user_id'] = $user->id;

        $dosen = Dosen::create($validateData);

        // for ($i=0; $i < count($request->role); $i++) { 
        //     $roles['role_id'] = $request->role[$i];
        //     $roles['dosen_id'] = $dosen->id;
        //     detail_role::create($roles);
        // }

        return redirect('master/dosen')->with([
            'case' => 'default',
            'type' => 'success',
            'message' => 'Add Dosen successfull!.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function show($nip)
    {
        return view('superadmin.master.show.show_dosen')->with([
            'title' => 'Dosen',
            'subtitle' => 'Details',
            'dosen' => Dosen::all()->where('nip', $nip)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function edit($nip)
    {
        return view('superadmin.master.edit.edit_dosen')->with([
            'title' => 'Dosen',
            'dosen' => dosen::where('nip', $nip)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dosen $dosen)
    {
        $rules = [
            'name' => 'required|min:3|max:255|regex:/^[\pL\s\-]+$/u',
            'birthPlace' => 'required|max:225|min:3',
            'birthDate' => 'required',
            'gender' => 'required'
        ];

        if($request->nip != $dosen->nip){
            $rules['nip'] = 'required|numeric|unique:dosens';
        }

        if($request->email != $dosen->email){
            $rules['email'] = 'required|min:5|max:255|unique:mahasiswas|email:dns';
        }

        if($request->phone != $dosen->phone){
            $rules['phone'] = 'required|numeric|unique:dosens';
        }

        $validateData = $request->validate($rules);
            
        Dosen::where('id', $dosen->id)
                    ->update($validateData);
        
        // for ($i=0; $i < count($request->role); $i++) { 
        //     $roles['role_id'] = $request->role[$i];
        //     $roles['dosen_id'] = $dosen->id;
        //     detail_role::create($roles);
        // }

        return redirect('master/dosen')->with([
            'case' => 'default',
            'type' => 'success',
            'message' => 'Edit Dosen Successfull!.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dosen::destroy($id);

        return redirect('master/dosen')->with([
            'case' => 'default',
            'type' => 'success',
            'message' => 'Delete Dosen Successfull!.'
        ]);
    }
}
