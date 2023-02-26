<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\TempRequest;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function request_index()
    {
        return view('mahasiswa.request.index');
    }

    public function request_read(Request $request)
    {
        if ($request->search === 'default') {
            return view('mahasiswa.request.data')->with([
                'surats' => Surat::where('status', 'active')->orderBy('id', 'ASC')->get()
            ]);
        }

        $surat = Surat::where('status', 'active')->orderBy('id', 'ASC')
                        ->where('name', 'LIKE', '%'.$request->search.'%')
                        ->orWhere('description', 'LIKE', '%'.$request->search.'%')
                        ->get();

        if ($surat->count() == 0) {
            return view('mahasiswa.request.data')->with([
                'surats' => Surat::where('status', 'active')->orderBy('id', 'ASC')->get()
            ]);
        }

        return view('mahasiswa.request.data')->with([
            'surats' => $surat
        ]);
    }

    public function request_surat(Surat $surat){
        return view('mahasiswa.request.data-modal')->with([
            'surat' => $surat
        ]);
    }

    public function request_store(Request $request){
        $surat = Surat::where('slug', $request->slug)->get();

        if (TempRequest::where('surat_id', $surat[0]->id)->count() > 0) {
            return false;
        }

        $data = [
            'mahasiswa_id' => auth()->user()->mahasiswa->id,
            'surat_id' => $surat[0]->id
        ];

        session(['request' => $request->session()->get('request')+1]);
        
        TempRequest::create($data);

        return true;
    }

    public function accept_index()
    {

    }
}
