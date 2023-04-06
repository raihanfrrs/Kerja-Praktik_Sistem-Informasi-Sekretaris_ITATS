<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Surat;
use App\Models\TempRequest;
use Illuminate\Http\Request;
use App\Models\DetailRequest;
use Illuminate\Support\Facades\Response;
use App\Models\Request as ModelsRequest;

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
        $surat = Surat::where('slug', $request->slug)->first();

        if (TempRequest::where('surat_id', $surat->id)->where('mahasiswa_id', auth()->user()->mahasiswa->id)->count() > 0) {
            return "exist";
        }

        $checkSuratExist = ModelsRequest::select('detail_requests.status')
                                        ->join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                        ->where('detail_requests.status', 'accepted')
                                        ->orWhere('detail_requests.status', 'pending')
                                        ->where('requests.mahasiswa_id', auth()->user()->mahasiswa->id)
                                        ->where('detail_requests.surat_id', $surat->id);

        $getSuratExists = $checkSuratExist->first();

        if ($checkSuratExist->count() > 0 && ($getSuratExists->status == 'accepted' || $getSuratExists->status == 'pending')) {
            return "doneYet";
        }

        $data = [
            'mahasiswa_id' => auth()->user()->mahasiswa->id,
            'surat_id' => $surat->id
        ];

        session(['request' => $request->session()->get('request')+1]);
        
        TempRequest::create($data);

        return "success";
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

    public function acception_index()
    {
        return view('mahasiswa.acception.index');
    }

    public function acception_read(Request $request)
    {
        if ($request->search === 'default') {
            return view('mahasiswa.acception.data')->with([
                'acceptions' => ModelsRequest::select('detail_requests.request_id', DetailRequest::raw('COUNT(*) as amount'), 'requests.status', 'requests.created_at')
                                            ->join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                            ->where('requests.mahasiswa_id', auth()->user()->mahasiswa->id)
                                            ->where('requests.created_at', '>', Carbon::now()->subWeek())
                                            ->where('requests.created_at', '<', Carbon::now())
                                            ->groupBy('detail_requests.request_id')
                                            ->get()
            ]);
        }

        if (empty($request->search)) {
            return view('mahasiswa.acception.data')->with([
                'acceptions' => ModelsRequest::select('detail_requests.request_id', DetailRequest::raw('COUNT(*) as amount'), 'requests.status', 'requests.created_at')
                                            ->join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                            ->where('requests.mahasiswa_id', auth()->user()->mahasiswa->id)
                                            ->where('requests.created_at', '>', Carbon::now()->subWeek())
                                            ->where('requests.created_at', '<', Carbon::now())
                                            ->groupBy('detail_requests.request_id')
                                            ->get()
            ]);
        }

        $modelRequests = ModelsRequest::select('detail_requests.request_id',)
                                    ->join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                    ->where('requests.mahasiswa_id', auth()->user()->mahasiswa->id)
                                    ->where('requests.created_at', '>', Carbon::now()->subWeek())
                                    ->where('requests.created_at', '<', Carbon::now())
                                    ->where('detail_requests.surat_id', function($query) use ($request) {
                                        $query->select('id')
                                            ->from('surats')
                                            ->where('name', 'LIKE', '%'.$request->search.'%');
                                    })
                                    ->groupBy('detail_requests.request_id')
                                    ->get();

        if ($modelRequests->count() == 0) {
            return view('mahasiswa.acception.data')->with([
                'acceptions' => ModelsRequest::select('detail_requests.request_id', DetailRequest::raw('COUNT(*) as amount'), 'requests.status', 'requests.created_at')
                                            ->join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                            ->where('requests.mahasiswa_id', auth()->user()->mahasiswa->id)
                                            ->where('requests.created_at', '>', Carbon::now()->subWeek())
                                            ->where('requests.created_at', '<', Carbon::now())
                                            ->groupBy('detail_requests.request_id')
                                            ->get()
            ]);
        }

        foreach ($modelRequests as $modelRequest) {
            $data[] = $modelRequest->request_id;
        }

        $requests = ModelsRequest::select('detail_requests.request_id', DetailRequest::raw('COUNT(*) as amount'), 'requests.status', 'requests.created_at')
                            ->join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                            ->where('requests.mahasiswa_id', auth()->user()->mahasiswa->id)
                            ->where('requests.created_at', '>', Carbon::now()->subWeek())
                            ->where('requests.created_at', '<', Carbon::now())
                            ->whereIn('detail_requests.request_id', $data)
                            ->groupBy('detail_requests.request_id')
                            ->get();

        return view('mahasiswa.acception.data')->with([
            'acceptions' => $requests
        ]);
    }

    public function acception_delete(Request $request)
    {
        if (ModelsRequest::whereId($request->id)->where('status', '!=', 'unfinished')->count() > 0) {
            return false;
        }

        if(ModelsRequest::whereId($request->id)->count() == 0){
            return false;
        }

        ModelsRequest::whereId($request->id)->update(['status' => 'canceled']);
        DetailRequest::where('request_id', $request->id)->update(['status' => 'canceled']);

        return true;
    }

    public function acception_detail(ModelsRequest $request)
    {
        if ($request->mahasiswa_id != auth()->user()->mahasiswa->id) {
            return back();
        }

        foreach ($request->detail_request as $file) {
            if ($file->surat) {
                $extension = pathinfo($file->surat, PATHINFO_EXTENSION);

                $iconMap = [
                    'pdf' => 'pdf.png',
                    'docx' => 'docx.jpg',
                    'pptx' => 'pptx.png',
                    'xlsx' => 'xlsx.jpg',
                ];
                $defaultIcon = 'default.jpg';
                $icon[] = array_key_exists($extension, $iconMap) ? $iconMap[$extension] : $defaultIcon;
            }
        }

        return view('mahasiswa.acception.detail')->with([
            'requests' => DetailRequest::whereNotNull('surat')
                                        ->where('request_id', $request->id)
                                        ->get(),
            'files' => $icon,
            'subtitle' => 'Detail'
        ]);
    }

    public function acception_download(DetailRequest $request)
    {
        if ($request->request->mahasiswa_id != auth()->user()->mahasiswa->id) {
            return back();
        }

        $pathToFile = public_path("storage/{$request->surat}");
        $extension = pathinfo($request->surat, PATHINFO_EXTENSION);
        

        return Response::download($pathToFile, $request->Surat->name.".".$extension);
    }
}