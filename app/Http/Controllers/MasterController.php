<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Dosen;
use App\Models\JenisSurat;
use App\Models\JobDosen;
use App\Models\JobRole;
use App\Models\Mahasiswa;
use App\Models\Role;
use App\Models\Surat;
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
        return view('superadmin.master.mahasiswa.add-mahasiswa')->with([
            'title' => 'Tambah',
            'subtitle' => 'Tambah'
        ]);
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
            'message' => 'Mahasiswa Berhasil Ditambahkan!'
        ]);
    }

    public function mahasiswa_show(Mahasiswa $mahasiswa)
    {
        return view('superadmin.master.mahasiswa.details-mahasiswa')->with([
            'mahasiswa' => Mahasiswa::whereId($mahasiswa->id)->get(),
            'created_at' => Carbon::create($mahasiswa->created_at)->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
            'title' => 'Rincian',
            'subtitle' => 'Rincian'
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

        $validateData['slug'] = slug($request->name);
        
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
        return view('superadmin.master.dosen.add-dosen')->with([
            'roles' => Role::where('status', 'active')->get()
        ]);
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
            'role_id' => 'required'
        ]);

        $validateData['level'] = 'dosen';
        $validateData['password'] = bcrypt($validateData['password']);

        $user = User::create($validateData);

        if ($request->file('image')) {
            $validateData['image'] = $request->file('image')->store('profile-image');
        }
        $validateData['user_id'] = $user->id;

        $dosen = Dosen::create($validateData);

        for ($i=0; $i < count($request->role_id); $i++) { 
            $data['dosen_id'] = $dosen->id;
            $data['role_id'] = $request->role_id[$i];
            JobDosen::create($data);
        }

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
            'roles' => JobDosen::where('dosen_id', $dosen->id)->get(),
            'created_at' => Carbon::create($dosen->created_at)->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
            'subtitle' => 'Details'
        ]);
    }
    
    public function dosen_edit(Dosen $dosen)
    {
        foreach ($dosen->job_dosen as $key => $value) {
            $data[] = $value->role_id;
        }
        
        return view('superadmin.master.dosen.edit-dosen')->with([
            'dosen' => $dosen,
            'data' => $data,
            'roles' => Role::where('status', 'active')->get()
        ]);
    }
    
    public function dosen_update(Request $request, Dosen $dosen)
    {
        $rules = [
            'name' => 'required|min:3|max:255|regex:/^[\pL\s\-]+$/u',
            'birthPlace' => 'required|max:225|min:3',
            'birthDate' => 'required',
            'gender' => 'required',
            'image' => 'image|file|max:2048'
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

        $request->validate(['role_id' => 'required']);

        JobDosen::where('dosen_id', $dosen->id)->delete();

        for ($i=0; $i < count($request->role_id); $i++) { 
            $data['dosen_id'] = $dosen->id;
            $data['role_id'] = $request->role_id[$i];

            JobDosen::create($data);
        }

        $validateData['slug'] = slug($request->name);
            
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
    
    /* CATEGORY METHOD SECTION */

    public function category_index()
    {
        return view('superadmin.master.category.index');
    }
    
    public function category_create()
    {
        return view('superadmin.master.category.add-category');
    }

    public function category_store(Request $request)
    {
        $validateData = $request->validate([
            'jenis' => 'required|min:2|max:255|unique:jenis_surats'
        ]);

        JenisSurat::create($validateData);

        return redirect('category/add')->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Surat Added!'
        ]);
    }
    
    public function category_edit(JenisSurat $category)
    {
        return view('superadmin.master.category.edit-category')->with([
            'category' => $category
        ]);
    }
    
    public function category_update(Request $request, JenisSurat $category)
    {
        $validateData = $request->validate([
            'jenis' => 'required|min:2|max:255|unique:jenis_surats'
        ]);

        $validateData['slug'] = slug($request->jenis);

        JenisSurat::findOrFail($category->id)->update($validateData);

        return redirect('category')->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Surat Updated!'
        ]);
    }
    
    public function category_show(JenisSurat $surat)
    {
        
    }
    
    public function category_destroy(Request $request, JenisSurat $category)
    {
        JenisSurat::findOrFail($category->id)->update(['status' => 'deactivated']);
        session(['deactivate' => $request->session()->get('deactivate')+1]);

        return redirect('category')->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Surat Deleted!'
        ]);
    }

    public function dataCategory()
    {
        return DataTables::of(JenisSurat::where('status', 'active')->get())
        ->addColumn('action', function ($model) {
            return view('superadmin.master.category.form-action', compact('model'))->render();
        })
        ->make(true);
    }

    /* CATEGORY METHOD END SECTION */

    /* SURAT METHOD SECTION */

    public function surat_index()
    {
        return view('superadmin.master.surat.index');
    }
    
    public function surat_create()
    {
        return view('superadmin.master.surat.add-surat')->with([
            'jenis_surats' => JenisSurat::where('status', 'active')->get()
        ]);
    }

    public function surat_store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|min:2|max:255|unique:surats',
            'jenis_surat_id' => 'required',
            'description' => 'required'
        ]);

        Surat::create($validateData);

        return redirect('surat/add')->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Surat Added!'
        ]);
    }
    
    public function surat_edit(Surat $surat)
    {
        return view('superadmin.master.surat.edit-surat')->with([
            'surat' => $surat,
            'jenis_surats' => JenisSurat::where('status', 'active')->get()
        ]);
    }
    
    public function surat_update(Request $request, Surat $surat)
    {
        $validateData = [
            'jenis_surat_id' => 'required',
            'description' => 'required'
        ];

        if ($request->name != $surat->name) {
            $validateData['name'] = 'required|min:2|max:255|unique:surats';
        }

        $rules = $request->validate($validateData);

        Surat::findOrFail($surat->id)->update($rules);

        return redirect('surat')->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Surat Updated!'
        ]);
    }
    
    public function surat_show(Surat $surat)
    {

    }
    
    public function surat_destroy(Request $request, Surat $surat)
    {
        Surat::findOrFail($surat->id)->update(['status' => 'deactivated']);
        session(['deactivate' => $request->session()->get('deactivate')+1]);

        return redirect('surat')->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Surat Deleted!'
        ]);
    }

    public function dataSurat()
    {
        return DataTables::of(Surat::join('jenis_surats', 'surats.jenis_surat_id', '=', 'jenis_surats.id')
                                    ->select('surats.*', 'jenis_surats.jenis')
                                    ->where('surats.status', 'active')
                                    ->get())
        ->addColumn('description', function ($model) {
            return view('superadmin.master.surat.data-desc', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('superadmin.master.surat.form-action', compact('model'))->render();
        })
        ->rawColumns(['description', 'action'])
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
        return view('superadmin.master.role.add-role')->with([
            'jenis_surats' => JenisSurat::where('status', 'active')->get()
        ]);
    }

    public function role_store(Request $request)
    {
        $validateData = $request->validate([
            'role' => 'required|min:2|max:255|unique:roles',
            'jenis_surat' => 'required'
        ]);

        $validateData['status'] = 'active';
        $role = Role::create($validateData);

        for ($i=0; $i < count($request->jenis_surat); $i++) { 
            $roles['role_id'] = $role->id;
            $roles['jenis_surat_id'] = $request->jenis_surat[$i];
            JobRole::create($roles);
        }

        return redirect('role/add')->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Role Added!'
        ]);
    }
    
    public function role_edit(Role $role)
    {
        return view('superadmin.master.role.edit-role')->with([
            'role' => $role,
            'jenis_surats' => JenisSurat::where('status', 'active')->get(),
            'job' => JobRole::where('role_id', $role->id)->get(),
        ]);
    }
    
    public function role_update(Request $request, Role $role)
    {
        $validateData = $request->validate([
            'jenis_surat' => 'required'
        ]);

        if ($request->role != $role->role) {
            $validateData = $request->validate([
                'role' => 'required|min:2|max:255|unique:roles'
            ]);

            Role::findOrFail($role->id)->update($validateData);
        }

        JobRole::where('role_id', $role->id)->delete();

        for ($i=0; $i < count($request->jenis_surat); $i++) { 
            $roles['role_id'] = $role->id;
            $roles['jenis_surat_id'] = $request->jenis_surat[$i];
            JobRole::create($roles);
        }

        return redirect('role')->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Role Updated!'
        ]);
    }
    
    public function role_show(Role $role)
    {
        return view('superadmin.master.role.data-modal')->with([
            'jobs' => JobRole::where('role_id', $role->id)->get()
        ]);
    }
    
    public function role_destroy(Request $request, Role $role)
    {
        Role::findOrFail($role->id)->update(['status' => 'deactivated']);
        session(['deactivate' => $request->session()->get('deactivate')+1]);

        return redirect('role')->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Role Deleted!'
        ]);
    }

    public function dataRole()
    {
        return DataTables::of(Role::where('status', 'active')->get())
        ->addColumn('action', function ($model) {
            return view('superadmin.master.role.form-action', compact('model'))->render();
        })
        ->make(true);
    }

    /* ROLE METHOD END SECTION */
}
