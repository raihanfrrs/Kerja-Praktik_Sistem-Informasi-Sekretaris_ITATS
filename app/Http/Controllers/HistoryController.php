<?php

namespace App\Http\Controllers;

use App\Models\DetailRequest;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class HistoryController extends Controller
{
    public function index()
    {
        if (auth()->user()->level === 'mahasiswa') {
            return view('mahasiswa.history.index');
        } else {
            
        }
    }

    public function dataRequestHistory()
    {
        return DataTables::of(ModelsRequest::rightJoin('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                        ->select('requests.id', DetailRequest::raw('COUNT(*) as amount'), ModelsRequest::raw('DATE_FORMAT(requests.created_at, "%d/%m/%Y") as date'), 'requests.status')
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