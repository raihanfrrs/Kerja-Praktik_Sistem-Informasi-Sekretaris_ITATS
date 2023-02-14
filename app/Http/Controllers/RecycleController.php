<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
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
        if (Mahasiswa::where('slug', $slug)->count() > 0) {
            Mahasiswa::where('slug', $slug)->update(['status' => 'recycle']);
            $check++;
        }elseif (Dosen::where('slug', $slug)->count() > 0) {
            Dosen::where('slug', $slug)->update(['status' => 'recycle']);
            $check++;
        }
        //kurang surat

        if ($check == 0) {
            return redirect('recycle')->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'error',
                'message' => 'Move to Recycle Failed!'
            ]);
        }

        session(['recycle' => $request->session()->get('recycle')+1]);

        return redirect('recycle')->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Move to Recycle Success!'
        ]);
    }
}