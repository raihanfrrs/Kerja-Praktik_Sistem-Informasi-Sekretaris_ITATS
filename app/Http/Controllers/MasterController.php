<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class MasterController extends Controller
{
    
    /* MAHASIWA METHOD SECTION */

    public function mahasiswa_index()
    {
        return view('superadmin.master.mahasiswa')->with([
            'mahasiswas' => Mahasiswa::all()
        ]);
    }
    
    public function mahasiswa_create()
    {
        return view('superadmin.master.create.create_mahasiswa');
    }

    public function mahasiswa_store(Request $request)
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
        $validateData['status'] = '1';
        $validateData['password'] = bcrypt($validateData['password']);

        $user = User::create($validateData);

        $validateData['user_id'] = $user->id;

        Mahasiswa::create($validateData);

        return redirect('mahasiswa/add')->with([
            'case' => 'default',
            'type' => 'success',
            'message' => 'Add Mahasiswa successfull!.'
        ]);
    }

    public function mahasiswa_show(Mahasiswa $mahasiswa)
    {
        return view('superadmin.master.show.show_mahasiswa')->with([
            'mahasiswa' => Mahasiswa::where('npm', $mahasiswa->id)->get()
        ]);
    }
    
    public function mahasiswa_edit(Mahasiswa $mahasiswa)
    {
        return view('superadmin.master.edit.edit_mahasiswa')->with([
            'mahasiswa' => Mahasiswa::where('npm', $mahasiswa->npm)->get()
        ]);
    }
    
    public function mahasiswa_update(Request $request, Mahasiswa $mahasiswa)
    {
        if($mahasiswa->status == '0'){
            Mahasiswa::where('npm', $mahasiswa->npm)->update(['status' => 1]);

            return redirect('mahasiswa');
        }elseif ($mahasiswa->status == '1') {
            Mahasiswa::where('npm', $mahasiswa->npm)->update(['status' => 0]);

            return redirect('mahasiswa');
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
        
        return redirect('mahasiswa')->with([
            'case' => 'default',
            'type' => 'success',
            'message' => 'Edit Mahasiswa Successfull!.'
        ]);
    }
    
    public function mahasiswa_destroy(Mahasiswa $mahasiswa)
    {
        Mahasiswa::destroy($mahasiswa->id);
        User::destroy($mahasiswa->user_id);

        return redirect('mahasiswa')->with([
            'case' => 'default',
            'type' => 'success',
            'message' => 'Delete Mahasiswa Successfull!.'
        ]);
    }

    /* MAHASISWA METHOD END SECTION */

    /* DOSEN METHOD SECTION */

    public function dosen_index()
    {
        return view('superadmin.master.dosen')->with([
            'dosen' => Dosen::all()
        ]);
    }
    
    public function dosen_create()
    {
        return view('superadmin.master.create.create_dosen');
    }

    public function dosen_store(Request $request)
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

        return redirect('dosen/add')->with([
            'case' => 'default',
            'type' => 'success',
            'message' => 'Add Dosen successfull!.'
        ]);
    }

    public function dosen_show(Dosen $dosen)
    {
        return view('superadmin.master.show.show_dosen')->with([
            'dosen' => Dosen::where('nip', $dosen->nip)->get()
        ]);
    }
    
    public function dosen_edit(Dosen $dosen)
    {
        return view('superadmin.master.edit.edit_dosen')->with([
            'dosen' => dosen::where('nip', $dosen->nip)->get()
        ]);
    }
    
    public function dosen_update(Request $request, Dosen $dosen)
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
            
        Dosen::whereId($dosen->id)
                    ->update($validateData);
        
        // for ($i=0; $i < count($request->role); $i++) { 
        //     $roles['role_id'] = $request->role[$i];
        //     $roles['dosen_id'] = $dosen->id;
        //     detail_role::create($roles);
        // }

        return redirect('dosen')->with([
            'case' => 'default',
            'type' => 'success',
            'message' => 'Edit Dosen Successfull!.'
        ]);
    }
    
    public function dosen_destroy(Dosen $dosen)
    {
        dosen::destroy($dosen->id);

        return redirect('dosen')->with([
            'case' => 'default',
            'type' => 'success',
            'message' => 'Delete Dosen Successfull!.'
        ]);
    }

    /* DOSEN METHOD END SECTION */
    
    /* SURAT METHOD SECTION */

    public function surat_index()
    {
        
    }
    
    public function surat_create()
    {
        
    }

    public function surat_store()
    {
        
    }
    
    public function surat_edit()
    {
        
    }
    
    public function surat_update()
    {
        
    }
    
    public function surat_show()
    {
        
    }
    
    public function surat_destroy()
    {
        
    }

    /* SURAT METHOD END SECTION */
}
