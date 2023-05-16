<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\TempRequest;
use Illuminate\Http\Request;
use App\Models\DetailRequest;
use App\Models\Request as ModelsRequest;

class RequestController extends Controller
{
    public function request_index()
    {
        return view('user.request.index')->with([
            'title' => 'Permintaan',
            'subtitle' => 'Permintaan'
        ]);
    }

    public function request_read(Request $request)
    {
        if ($request->search === 'default') {
            return view('user.request.data')->with([
                'surats' => Surat::where('status', 'active')
                                ->where('level', auth()->user()->level)
                                ->orderBy('id', 'ASC')->get()
            ]);
        }

        $surat = Surat::where('status', 'active')
                        ->where('level', auth()->user()->level)
                        ->where('name', 'LIKE', '%'.$request->search.'%')
                        ->orWhere('description', 'LIKE', '%'.$request->search.'%')
                        ->orderBy('id', 'ASC')
                        ->get();

        if ($surat->count() == 0) {
            return view('user.request.data')->with([
                'surats' => Surat::where('status', 'active')
                                ->where('level', auth()->user()->level)
                                ->orderBy('id', 'ASC')
                                ->get()
            ]);
        }

        return view('user.request.data')->with([
            'surats' => $surat
        ]);
    }

    public function request_surat(Surat $surat){
        return view('user.request.data-surat-modal')->with([
            'surat' => $surat
        ]);
    }

    public function request_store(Request $request){
        $surat = Surat::where('slug', $request->slug)->first();

        if (TempRequest::where('surat_id', $surat->id)->where('user_id', auth()->user()->id)->count() > 0) {
            return "exist";
        }

        $checkSuratExist = ModelsRequest::select('detail_requests.status')
                                        ->join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                        ->whereIn('detail_requests.status', ['accepted', 'pending'])
                                        ->where('requests.user_id', auth()->user()->id)
                                        ->where('detail_requests.surat_id', $surat->id);

        $getSuratExists = $checkSuratExist->first();

        if ($checkSuratExist->count() > 0 && ($getSuratExists->status == 'accepted' || $getSuratExists->status == 'pending')) {
            return "doneYet";
        }

        $data = [
            'user_id' => auth()->user()->id,
            'surat_id' => $surat->id
        ];

        session(['request' => $request->session()->get('request')+1]);
        
        TempRequest::create($data);

        return "success";
    }

    public function request_show(){
        return view('user.request.data-request-modal')->with([
            'requests' => TempRequest::where('user_id', auth()->user()->id)->get()
        ]);
    }

    public function request_delete(Request $request){
        $surat = Surat::where('slug', $request->slug)->get();

        if ($surat->count() == 0) {
            return false;
        }

        session(['request' => $request->session()->get('request')-1]);

        TempRequest::where('surat_id', $surat[0]->id)
                    ->where('user_id', auth()->user()->id)
                    ->delete();

        return view('user.request.data-request-modal')->with([
            'requests' => TempRequest::where('user_id', auth()->user()->id)->get()
        ]);
    }

    public function request_send(Request $request){
        $tempRequest = TempRequest::where('user_id', auth()->user()->id)->get();

        $data['user_id'] = auth()->user()->id;

        $request = ModelsRequest::create($data);
        foreach ($tempRequest as $key => $value) {
            $data['request_id'] = $request->id;
            $data['surat_id'] = $value->surat_id;
            DetailRequest::create($data);
        }

        TempRequest::where('user_id', auth()->user()->id)->delete();
        session()->forget('request');

        return true;
    }
}
