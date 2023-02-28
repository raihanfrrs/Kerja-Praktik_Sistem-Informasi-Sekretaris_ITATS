<?php

namespace App\Http\Controllers;

use App\Models\DetailRequest;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\TempRequest;

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
        return view('mahasiswa.request.data-surat-modal')->with([
            'surat' => $surat
        ]);
    }

    public function request_store(Request $request){
        $surat = Surat::where('slug', $request->slug)->get();

        if (TempRequest::where('surat_id', $surat[0]->id)->where('mahasiswa_id', auth()->user()->mahasiswa->id)->count() > 0) {
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

    public function request_show(){
        return view('mahasiswa.request.data-request-modal')->with([
            'requests' => TempRequest::where('mahasiswa_id', auth()->user()->mahasiswa->id)->get()
        ]);
    }

    public function request_delete(Request $request){
        $surat = Surat::where('slug', $request->slug)->get();

        if ($surat->count() == 0) {
            return false;
        }

        session(['request' => $request->session()->get('request')-1]);

        TempRequest::where('surat_id', $surat[0]->id)
                    ->where('mahasiswa_id', auth()->user()->mahasiswa->id)
                    ->delete();

        return view('mahasiswa.request.data-request-modal')->with([
            'requests' => TempRequest::where('mahasiswa_id', auth()->user()->mahasiswa->id)->get()
        ]);
    }

    public function request_send(Request $request){
        $tempRequest = TempRequest::where('mahasiswa_id', auth()->user()->mahasiswa->id)->get();

        $data['mahasiswa_id'] = auth()->user()->mahasiswa->id;

        $request = ModelsRequest::create($data);
        foreach ($tempRequest as $key => $value) {
            $data['request_id'] = $request->id;
            $data['surat_id'] = $value->surat_id;
            DetailRequest::create($data);
        }

        TempRequest::where('mahasiswa_id', auth()->user()->mahasiswa->id)->delete();
        session()->forget('request');

        return true;
    }

    public function accept_index()
    {

    }
}
