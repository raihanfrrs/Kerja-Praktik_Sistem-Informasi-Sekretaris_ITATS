<?php

namespace App\Http\Controllers;

use App\Models\Broadcast;
use App\Models\DetailBroadcast;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\DetailRequest;
use App\Models\Request as ModelsRequest;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

class AcceptionController extends Controller
{
    public function acception_index()
    {
        return view('user.acception.index')->with([
            'title' => 'Penerimaan',
            'subtitle' => 'Penerimaan'
        ]);
    }

    public function acception_read(Request $request)
    {
        if ($request->search === 'default') {
            return view('user.acception.data')->with([
                'acceptions' => ModelsRequest::select('requests.id', 'detail_requests.request_id', DetailRequest::raw('COUNT(*) as amount'), 'requests.status', 'requests.created_at')
                                            ->join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                            ->where('requests.user_id', auth()->user()->id)
                                            ->where('requests.created_at', '>', Carbon::now()->subWeek())
                                            ->where('requests.created_at', '<', Carbon::now())
                                            ->groupBy('detail_requests.request_id')
                                            ->get()
            ]);
        }

        if (empty($request->search)) {
            return view('user.acception.data')->with([
                'acceptions' => ModelsRequest::select('requests.id', 'detail_requests.request_id', DetailRequest::raw('COUNT(*) as amount'), 'requests.status', 'requests.created_at')
                                            ->join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                            ->where('requests.user_id', auth()->user()->id)
                                            ->where('requests.created_at', '>', Carbon::now()->subWeek())
                                            ->where('requests.created_at', '<', Carbon::now())
                                            ->groupBy('detail_requests.request_id')
                                            ->get()
            ]);
        }

        $modelRequests = ModelsRequest::select('detail_requests.request_id')
                                    ->join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                    ->where('requests.user_id', auth()->user()->id)
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
            return view('user.acception.data')->with([
                'acceptions' => ModelsRequest::select('requests.id', 'detail_requests.request_id', DetailRequest::raw('COUNT(*) as amount'), 'requests.status', 'requests.created_at')
                                            ->join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                            ->where('requests.user_id', auth()->user()->id)
                                            ->where('requests.created_at', '>', Carbon::now()->subWeek())
                                            ->where('requests.created_at', '<', Carbon::now())
                                            ->groupBy('detail_requests.request_id')
                                            ->get()
            ]);
        }

        foreach ($modelRequests as $modelRequest) {
            $data[] = $modelRequest->request_id;
        }

        $requests = ModelsRequest::select('requests.id', 'detail_requests.request_id', DetailRequest::raw('COUNT(*) as amount'), 'requests.status', 'requests.created_at')
                            ->join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                            ->where('requests.user_id', auth()->user()->id)
                            ->where('requests.created_at', '>', Carbon::now()->subWeek())
                            ->where('requests.created_at', '<', Carbon::now())
                            ->whereIn('detail_requests.request_id', $data)
                            ->groupBy('detail_requests.request_id')
                            ->get();

        return view('user.acception.data')->with([
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
        if ($request->user_id != auth()->user()->id) {
            return back();
        }

        foreach ($request->detail_request as $file) {
            $extension = pathinfo($file->surat, PATHINFO_EXTENSION);

            $iconMap = [
                'pdf' => 'pdf.png',
                'docx' => 'docx.jpg',
                'doc' => 'doc.jpg',
                'pptx' => 'pptx.png',
                'ppt' => 'ppt.png',
                'xlsx' => 'xlsx.jpg',
                'xls' => 'xls.jpg',
            ];
            
            $defaultIcon = 'default.png';
            $icon[] = array_key_exists($extension, $iconMap) ? $iconMap[$extension] : $defaultIcon;
        }

        return view('user.acception.detail')->with([
            'requestsNotNull' => DetailRequest::whereNotNull('surat')
                                        ->where('request_id', $request->id)
                                        ->get(),
            'requestsNull' => DetailRequest::whereNull('surat')
                                        ->where('request_id', $request->id)
                                        ->get(),
            'files' => $icon,
            'title' => 'Rincian Permintaan',
            'subtitle' => 'Rincian Permintaan'
        ]);
    }

    public function acception_download(DetailRequest $request)
    {
        if ($request->request->user_id != auth()->user()->id) {
            return back();
        }

        $pathToFile = public_path("storage/{$request->surat}");
        $extension = pathinfo($request->surat, PATHINFO_EXTENSION);

        return Response::download($pathToFile, $request->Surat->name.".".$extension);
    }

    public function broadcast_index()
    {
        return view('user.broadcast.index')->with([
            'title' => 'Penyiaran',
            'subtitle' => 'Penyiaran'
        ]);
    }

    public function broadcast_show(Broadcast $broadcast)
    {
        foreach (unserialize($broadcast->surat) as $file) {
            $surat[] = $file;

            $extension = pathinfo($file, PATHINFO_EXTENSION);

            $iconMap = [
                'pdf' => 'pdf.png',
                'docx' => 'docx.jpg',
                'doc' => 'doc.jpg',
                'pptx' => 'pptx.png',
                'ppt' => 'ppt.png',
                'xlsx' => 'xlsx.jpg',
                'xls' => 'xls.jpg',
            ];
            
            $defaultIcon = 'default.png';
            $icon[] = array_key_exists($extension, $iconMap) ? $iconMap[$extension] : $defaultIcon;
        }

        foreach (unserialize($broadcast->name) as $names) {
            $name[] = $names;
        }

        return view('user.broadcast.details-broadcast')->with([
            'broadcast' => $broadcast,
            'files' => $surat,
            'names' => $name,
            'icon' => $icon,
            'title' => 'Penyiaran',
            'subtitle' => 'Penyiaran'
        ]);
    }

    public function broadcast_download($id, $key)
    {
        $broadcast = Broadcast::whereId($id)->first();

        $surat = unserialize($broadcast->surat);
        $name = unserialize($broadcast->name);

        $pathToFile = public_path("storage/{$surat[$key]}");
        $extension = pathinfo($surat[$key], PATHINFO_EXTENSION);

        return Response::download($pathToFile, $name[$key].".".$extension);
    }

    public function dataBroadcastList()
    {
        return DataTables::of(DetailBroadcast::join('broadcasts', 'detail_broadcasts.broadcast_id', '=', 'broadcasts.id')
                                            ->join('users', 'broadcasts.user_id', '=', 'users.id')
                                            ->join('dosens', 'users.id', '=', 'dosens.user_id')
                                            ->select('broadcasts.id', Broadcast::raw('DATE_FORMAT(broadcasts.created_at, "%d/%m/%Y %H:%i:%s") as date'), 'dosens.name', 'dosens.slug', 'broadcasts.surat')
                                            ->where('detail_broadcasts.dosen_id', auth()->user()->dosen->id)
                                            ->get())
        ->addColumn('amount', function ($model) {
            return view('user.broadcast.data-amount', compact('model'))->render();
        })
        ->addColumn('sender', function ($model) {
            return view('user.broadcast.data-sender', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('user.broadcast.form-action', compact('model'))->render();
        })
        ->rawColumns(['amount', 'sender', 'action'])
        ->make(true);
    }
}
