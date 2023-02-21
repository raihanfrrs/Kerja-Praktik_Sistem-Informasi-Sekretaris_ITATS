<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Dosen;
use App\Models\JenisSurat;
use App\Models\Mahasiswa;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rules\Password;

class MasterController extends Controller
{
    
    /* MAHASIWA METHOD SECTION */

    public function mahasiswa_index()
    {
        return view('superadmin.master.mahasiswa.index');
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
            'gender' => 'required',
            'image' => 'image|file|max:2048'
        ]);

        $validateData['level'] = 'mahasiswa';
        $validateData['status'] = 'approve';
        $validateData['password'] = bcrypt($validateData['password']);

        $user = User::create($validateData);

        if ($request->file('image')) {
            $validateData['image'] = $request->file('image')->store('profile-image');
        }
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
            'created_at' => Carbon::create($mahasiswa->created_at)->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
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
            if($mahasiswa->status == 'disapprove'){
                Mahasiswa::where('npm', $mahasiswa->npm)->update(['status' => 'approved']);
    
                return redirect('mahasiswa')->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Status Updated!'
                ]);
            }elseif ($mahasiswa->status == 'approved') {
                Mahasiswa::where('npm', $mahasiswa->npm)->update(['status' => 'disapprove']);
    
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
            'gender' => 'required',
            'image' => 'image|file|max:2048'
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

        if ($request->file('image')) {
            if ($mahasiswa->image) {
                Storage::delete($mahasiswa->image);
            }
            $validateData['image'] = $request->file('image')->store('profile-image');
        }
        
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
    
    public function mahasiswa_destroy(Request $request, Mahasiswa $mahasiswa)
    {
        Mahasiswa::findOrFail($mahasiswa->id)->update(['status' => 'deactivated']);
        session(['deactivate' => $request->session()->get('deactivate')+1]);
    }

    public function dataMahasiswa()
    {
        return DataTables::of(Mahasiswa::where('status', 'approved')
                                        ->orWhere('status', 'disapprove')
                                        ->get())
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
        return view('superadmin.master.dosen.index');
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
            'email' => 'required|min:5|max:255|unique:dosens|email:dns',
            'phone' =>'required|numeric|unique:dosens',
            'birthPlace' => 'required|max:225|min:3',
            'birthDate' => 'required',
            'gender' => 'required',
            'image' => 'image|file|max:2048',
            'role' => 'required'
        ]);

        $validateData['level'] = 'dosen';
        $validateData['password'] = bcrypt($validateData['password']);

        $user = User::create($validateData);

        if ($request->file('image')) {
            $validateData['image'] = $request->file('image')->store('profile-image');
        }
        $validateData['user_id'] = $user->id;
        $validateData['role'] = implode(',', $request->role);

        Dosen::create($validateData);

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
            'created_at' => Carbon::create($dosen->created_at)->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
            'subtitle' => 'Details'
        ]);
    }
    
    public function dosen_edit(Dosen $dosen)
    {
        return view('superadmin.master.dosen.edit-dosen')->with([
            'dosen' => $dosen,
            'role' => explode(',', $dosen->role)
        ]);
    }
    
    public function dosen_update(Request $request, Dosen $dosen)
    {
        $rules = [
            'name' => 'required|min:3|max:255|regex:/^[\pL\s\-]+$/u',
            'birthPlace' => 'required|max:225|min:3',
            'birthDate' => 'required',
            'gender' => 'required',
            'image' => 'image|file|max:2048',
            'role' => 'required'
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

        if ($request->file('image')) {
            if ($dosen->image) {
                Storage::delete($dosen->image);
            }
            $validateData['image'] = $request->file('image')->store('profile-image');
        }

        $validateData['role'] = implode(',', $request->role);
            
        Dosen::whereId($dosen->id)
                    ->update($validateData);

        return redirect('dosen')->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Dosen Updated!'
        ]);
    }
    
    public function dosen_destroy(Request $request, Dosen $dosen)
    {
        Dosen::findOrFail($dosen->id)->update(['status' => 'deactivated']);
        session(['deactivate' => $request->session()->get('deactivate')+1]);
    }

    public function dataDosen()
    {
        return DataTables::of(Dosen::join('users', 'dosens.user_id', '=', 'users.id')
                                    ->select('dosens.*')
                                    ->where('users.level', 'dosen')
                                    ->where('status', 'active')
                                    ->orderBy('dosens.user_id', 'DESC')
                                    ->get())
        ->addColumn('action', function ($model) {
            return view('superadmin.master.dosen.form-action', compact('model'))->render();
        })
        ->make(true);
    }

    /* DOSEN METHOD END SECTION */
    
    /* SURAT METHOD SECTION */

    public function surat_index()
    {
        return view('superadmin.master.surat.index');
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
    
    public function surat_show(JenisSurat $surat)
    {
        dd
        return view('superadmin.master.surat.data-modal');
    }
    
    public function surat_destroy()
    {
        
    }

    public function dataSurat()
    {
        return DataTables::of(JenisSurat::all())
        ->addColumn('action', function ($model) {
            return view('superadmin.master.surat.form-action', compact('model'))->render();
        })
        ->make(true);
    }

    /* SURAT METHOD END SECTION */

    /* ROLE METHOD SECTION */

    public function role_index()
    {
        return view('superadmin.master.role.index');
    }
    
    public function role_create()
    {
        
    }

    public function role_store()
    {
        
    }
    
    public function role_edit()
    {
        
    }
    
    public function role_update()
    {
        
    }
    
    public function role_show()
    {
        
    }
    
    public function role_destroy()
    {
        
    }

    public function dataRole()
    {
        return DataTables::of(Role::all())
        ->addColumn('action', function ($model) {
            return view('superadmin.master.role.form-action', compact('model'))->render();
        })
        ->make(true);
    }

    /* ROLE METHOD END SECTION */
}
