<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;

class RecycleController extends Controller
{
    public function index()
    {
        return view('superadmin.recycle.index')->with([
            'mahasiswas' => Mahasiswa::where('status', 'deactivated')->get(),
            'dosens' => Dosen::where('status', 'deactivated')->get()
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
        }
        //kurang surat

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

        if ($mahasiswa->count() > 0) {
            Mahasiswa::where('slug', $slug)->delete();
            User::whereId($mahasiswa[0]->user_id)->delete();
            $check++;
        }elseif (Dosen::where('slug', $slug)->count() > 0) {
            Dosen::where('slug', $slug)->delete();
            User::whereId($dosen[0]->user_id)->delete();
            $check++;
        }
        //kurang surat

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