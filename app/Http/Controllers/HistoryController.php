<?php

namespace App\Http\Controllers;

use App\Models\DetailRequest;
use App\Models\Request as ModelsRequest;
use Yajra\DataTables\Facades\DataTables;

class HistoryController extends Controller
{
    public function index()
    {
        if (auth()->user()->level === 'mahasiswa') {
            return view('mahasiswa.history.index');
        } else {
            return view('dosen.history.index');
        }
    }

    public function dataRequestHistory()
    {
        return DataTables::of(ModelsRequest::rightJoin('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                        ->select('requests.id', DetailRequest::raw('COUNT(*) as amount'), ModelsRequest::raw('DATE_FORMAT(requests.created_at, "%d/%m/%Y %H:%i:%s") as date'), 'requests.status')
                                        ->where('requests.mahasiswa_id', auth()->user()->mahasiswa->id)
                                        ->groupBy('requests.id')
                                        ->get())
        ->addColumn('status', function ($model) {
            return view('mahasiswa.history.status-action', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('mahasiswa.history.form-action', compact('model'))->render();
        })
        ->rawColumns(['status', 'action'])
        ->make(true);
    }

    public function dataAssignHistory()
    {
        return DataTables::of(DetailRequest::select('requests.id', 'mahasiswas.name', ModelsRequest::raw('DATE_FORMAT(requests.created_at, "%d/%m/%Y %H:%i:%s") as date'), 'requests.status')
                                        ->join('requests', 'detail_requests.request_id', '=', 'requests.id')
                                        ->join('mahasiswas', 'requests.mahasiswa_id', '=', 'mahasiswas.id')
                                        ->where('detail_requests.dosen_id', auth()->user()->dosen->id)
                                        ->groupBy('requests.id')
                                        ->get())
        ->addColumn('name', function ($model) {
            return view('dosen.history.mahasiswa-action', compact('model'))->render();
        })
        ->addColumn('status', function ($model) {
            return view('dosen.history.status-action', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('dosen.history.form-action', compact('model'))->render();
        })
        ->rawColumns(['name', 'status', 'action'])
        ->make(true);
    }

    public function destroy(ModelsRequest $request){
        ModelsRequest::findOrFail($request->id)->delete();
        DetailRequest::where('request_id', $request->id)->delete();

        return redirect('history')->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Request History Deleted!'
        ]);
    }
}