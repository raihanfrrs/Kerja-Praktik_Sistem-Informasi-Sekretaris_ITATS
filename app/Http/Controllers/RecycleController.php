<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\JenisSurat;
use App\Models\JobDosen;
use App\Models\JobRole;
use App\Models\Mahasiswa;
use App\Models\Role;
use App\Models\Surat;
use App\Models\User;
use Illuminate\Http\Request;

class RecycleController extends Controller
{
    public function index()
    {
        return view('superadmin.recycle.index')->with([
            'mahasiswas' => Mahasiswa::where('status', 'deactivated')->get(),
            'dosens' => Dosen::where('status', 'deactivated')->get(),
            'jenis_surats' => JenisSurat::where('status', 'deactivated')->get(),
            'surats' => Surat::where('status', 'deactivated')->get(),
            'roles' => Role::where('roles.status', 'deactivated')
                            ->groupBy('roles.id')
                            ->get()
        ]);
    }

    public function update(Request $request, $slug)
    {
        $check = 0;
        if (Mahasiswa::where('slug', $slug)->count() > 0) {
            Mahasiswa::where('slug', $slug)->update(['status' => 'disapprove']);
            $check++;
        }elseif (Dosen::where('slug', $slug)->count() > 0) {
            Dosen::where('slug', $slug)->update(['status' => 'active']);
            $check++;
        }elseif (JenisSurat::where('slug', $slug)->count() > 0) {
            JenisSurat::where('slug', $slug)->update(['status' => 'active']);
            $check++;
        }elseif (Surat::where('slug', $slug)->count() > 0) {
            Surat::where('slug', $slug)->update(['status' => 'active']);
            $check++;
        }elseif (Role::where('slug', $slug)->count() > 0) {
            Role::where('slug', $slug)->update(['status' => 'active']);
            $check++;
        }

        if ($check == 0) {
            return redirect('recycle')->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'error',
                'message' => 'Restore Failed!'
            ]);
        }

        session(['deactivate' => $request->session()->get('deactivate')-1]);

        return redirect('recycle')->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Restore Success!'
        ]);
    }

    public function destroy(Request $request, $slug)
    {
        $check = 0;
        $mahasiswa = Mahasiswa::where('slug', $slug)->get();
        $dosen = Dosen::where('slug', $slug)->get();
        $jenis_surat = JenisSurat::where('slug', $slug)->get();
        $surat = Surat::where('slug', $slug)->get();
        $role = Role::where('slug', $slug)->get();

        if ($mahasiswa->count() > 0) {
            Mahasiswa::where('slug', $slug)->delete();
            User::whereId($mahasiswa[0]->user_id)->delete();
            $check++;
        }elseif (Dosen::where('slug', $slug)->count() > 0) {
            Dosen::where('slug', $slug)->delete();
            User::whereId($dosen[0]->user_id)->delete();
            $check++;
        }elseif (JenisSurat::where('slug', $slug)->count() > 0) {
            JenisSurat::where('slug', $slug)->delete();
            JobRole::where('jenis_surat_id', $jenis_surat[0]->id)->delete();
            $check++;
        }elseif (Surat::where('slug', $slug)->count() > 0) {
            Surat::where('slug', $slug)->delete();
            $check++;
        }elseif (Role::where('slug', $slug)->count() > 0) {
            Role::where('slug', $slug)->delete();
            JobDosen::where('role_id', $role[0]->id)->delete();
            $check++;
        }

        if ($check == 0) {
            return redirect('recycle')->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'error',
                'message' => 'Delete Failed!'
            ]);
        }

        session(['deactivate' => $request->session()->get('deactivate')-1]);

        return redirect('recycle')->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Delete Success!'
        ]);
    }
}