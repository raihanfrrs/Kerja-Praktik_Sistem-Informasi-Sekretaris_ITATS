<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rules\Password;

class MasterController extends Controller
{
    
    /* MAHASIWA METHOD SECTION */

    public function mahasiswa_index()
    {
        return view('superadmin.master.mahasiswa.index')->with([
            'mahasiswas' => Mahasiswa::all()
        ]);
    }
    
    public function mahasiswa_create()
    {
        return view('superadmin.master.mahasiswa.add-mahasiswa');
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
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Mahasiswa Added!'
        ]);
    }

    public function mahasiswa_show(Mahasiswa $mahasiswa)
    {
        return view('superadmin.master.mahasiswa.details-mahasiswa')->with([
            'mahasiswa' => Mahasiswa::whereId($mahasiswa->id)->get(),
            'subtitle' => 'Details'
        ]);
    }
    
    public function mahasiswa_edit(Mahasiswa $mahasiswa)
    {
        return view('superadmin.master.mahasiswa.edit-mahasiswa')->with([
            'mahasiswa' => Mahasiswa::whereId($mahasiswa->id)->get()
        ]);
    }
    
    public function mahasiswa_update(Request $request, Mahasiswa $mahasiswa)
    {
        if($request->status === 'checked'){
            if($mahasiswa->status == '0'){
                Mahasiswa::where('npm', $mahasiswa->npm)->update(['status' => 1]);
    
                return redirect('mahasiswa')->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Status Updated!'
                ]);
            }elseif ($mahasiswa->status == '1') {
                Mahasiswa::where('npm', $mahasiswa->npm)->update(['status' => 0]);
    
                return redirect('mahasiswa')->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Status Updated!'
                ]);
            }
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
            
        Mahasiswa::whereId($mahasiswa->id)
                    ->update($validateData);
        
        return redirect('mahasiswa')->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Mahasiswa Updated!'
        ]);
    }
    
    public function mahasiswa_destroy(Mahasiswa $mahasiswa)
    {
        Mahasiswa::destroy($mahasiswa->id);
        User::destroy($mahasiswa->user_id);

        return redirect('mahasiswa')->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Mahasiswa Deleted!'
        ]);
    }

    public function dataMahasiswa()
    {
        return DataTables::of(Mahasiswa::all())
        ->addColumn('number', function ($model) {
            return "1";
        })
        ->addColumn('status', function ($model) {
            return view('superadmin.master.mahasiswa.status-action', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('superadmin.master.mahasiswa.form-action', compact('model'))->render();
        })
        ->rawColumns(['status', 'action'])
        ->make(true);
    }

    /* MAHASISWA METHOD END SECTION */

    /* DOSEN METHOD SECTION */

    public function dosen_index()
    {
        return view('superadmin.master.dosen.index')->with([
            'dosens' => Dosen::all()
        ]);
    }
    
    public function dosen_create()
    {
        return view('superadmin.master.dosen.add-dosen');
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
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Dosen Added!'
        ]);
    }

    public function dosen_show(Dosen $dosen)
    {
        return view('superadmin.master.dosen.details-dosen')->with([
            'dosen' => Dosen::whereId($dosen->id)->get(),
            'subtitle' => 'Details'
        ]);
    }
    
    public function dosen_edit(Dosen $dosen)
    {
        return view('superadmin.master.dosen.edit-dosen')->with([
            'dosen' => dosen::whereId($dosen->id)->get()
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
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Dosen Updated!'
        ]);
    }
    
    public function dosen_destroy(Dosen $dosen)
    {
        Dosen::destroy($dosen->id);
        User::destroy($dosen->user_id);

        return redirect('dosen')->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Dosen Deleted!'
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
