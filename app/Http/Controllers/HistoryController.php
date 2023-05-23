<?php

namespace App\Http\Controllers;

use App\Models\DetailRequest;
use App\Models\Request as ModelsRequest;
use Yajra\DataTables\Facades\DataTables;

class HistoryController extends Controller
{
    public function index()
    {
        if (auth()->user()->level === 'mahasiswa' || auth()->user()->level === 'dosen') {
            return view('user.history.index')->with([
                'title' => 'Riwayat',
                'subtitle' => 'Riwayat'
            ]);
        } else {
            return view('admin.history.index')->with([
                'title' => 'Riwayat',
                'subtitle' => 'Riwayat'
            ]);
        }
    }

    public function dataRequestHistory()
    {
        return DataTables::of(ModelsRequest::rightJoin('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                        ->select('requests.id', DetailRequest::raw('COUNT(*) as amount'), ModelsRequest::raw('DATE_FORMAT(requests.created_at, "%d/%m/%Y %H:%i:%s") as date'), 'requests.status')
                                        ->where('requests.user_id', auth()->user()->id)
                                        ->groupBy('requests.id')
                                        ->orderBy('requests.created_at', 'DESC')
                                        ->get())
        ->addColumn('status', function ($model) {
            return view('user.history.status-action', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('user.history.form-action', compact('model'))->render();
        })
        ->rawColumns(['status', 'action'])
        ->make(true);
    }

    public function dataAssignHistory()
    {
        return DataTables::of(ModelsRequest::rightJoin('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                        ->select('requests.id', 'requests.user_id', ModelsRequest::raw('DATE_FORMAT(requests.created_at, "%d/%m/%Y %H:%i:%s") as date'), 'requests.status')
                                        ->where('detail_requests.dosen_id', auth()->user()->dosen->id)
                                        ->groupBy('requests.id')
                                        ->orderBy('requests.created_at', 'DESC')
                                        ->get())
        ->addColumn('name', function ($model) {
            return view('admin.history.user-action', compact('model'))->render();
        })
        ->addColumn('level', function ($model) {
            return view('admin.history.level-action', compact('model'))->render();
        })
        ->addColumn('status', function ($model) {
            return view('admin.history.status-action', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('admin.history.form-action', compact('model'))->render();
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