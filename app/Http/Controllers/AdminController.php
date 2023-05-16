<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\DetailRequest;
use App\Models\Request as ModelsRequest;

class AdminController extends Controller
{
    public function receive_index()
    {
        return view('admin.receive.index')->with([
            'title' => 'Penerimaan',
            'subtitle' => 'Penerimaan'
        ]);
    }

    public function receive_read(Request $request)
    {
        if ($request->search === 'default') {
            return view('admin.receive.data')->with([
                'receives' => ModelsRequest::select('requests.id as request_id', 'requests.user_id', ModelsRequest::raw('max(requests.created_at) as date'))
                                        ->join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                        ->where('requests.status', '!=','finished')
                                        ->where('requests.status', '!=','rejected')
                                        ->where('detail_requests.status', 'pending')
                                        ->groupBy('requests.user_id')
                                        ->groupBy('requests.id')
                                        ->get()
            ]);
        }

        $requests = ModelsRequest::select('requests.id as request_id', 'requests.user_id', ModelsRequest::raw('max(requests.created_at) as date'))
                            ->join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                            ->join('mahasiswas', 'requests.user_id', '=', 'mahasiswas.id')
                            ->join('dosens', 'requests.user_id', '=', 'dosens.id')
                            ->where('requests.status', '!=','finished')
                            ->where('requests.status', '!=','rejected')
                            ->where('detail_requests.status', 'pending')
                            ->where('detail_requests.dosen_id', auth()->user()->dosen->id)
                            ->whereIn('mahasiswas.id', function($query) use ($request){
                                $query->select('id')
                                    ->from('mahasiswas')
                                    ->where('name', 'LIKE', '%'.$request->search.'%')
                                    ->orWhere('npm', 'LIKE', '%'.$request->search.'%')
                                    ->orWhere('email', 'LIKE', '%'.$request->search.'%')
                                    ->orWhere('phone', 'LIKE', '%'.$request->search.'%');
                            })
                            ->whereIn('dosens.id', function($query) use ($request){
                                $query->select('id')
                                    ->from('dosens')
                                    ->where('name', 'LIKE', '%'.$request->search.'%')
                                    ->orWhere('npm', 'LIKE', '%'.$request->search.'%')
                                    ->orWhere('email', 'LIKE', '%'.$request->search.'%')
                                    ->orWhere('phone', 'LIKE', '%'.$request->search.'%');
                            })
                            ->groupBy('requests.user_id')
                            ->groupBy('requests.id')
                            ->get();

        if ($requests->count() == 0 || $request->search == null) {
            return view('admin.receive.data')->with([
                'receives' => ModelsRequest::select('requests.user_id', ModelsRequest::raw('max(requests.created_at) as date'))
                                        ->join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                        ->where('requests.status', '!=','finished')
                                        ->where('requests.status', '!=','rejected')
                                        ->where('detail_requests.status', 'pending')
                                        ->groupBy('requests.user_id')
                                        ->get()
            ]);
        }

        return view('admin.receive.data')->with([
            'receives' => $requests
        ]);
    }

    public function receive_store(Request $request)
    {
        if (Mahasiswa::where('slug', $request->slug)->count() > 0) {
            $user = Mahasiswa::where('slug', $request->slug)->first();
        }else {
            $user = Dosen::where('slug', $request->slug)->first();
        }

        if (ModelsRequest::whereId($request->id)->where('user_id', $user->user_id)->where('status', 'finished')->count() > 0) {
            return 'finished';
        }

        $detailRequests =  DetailRequest::select('detail_requests.*')
                                        ->join('requests', 'detail_requests.request_id', '=', 'requests.id')
                                        ->where('requests.user_id', $user->user_id)
                                        ->get();

        $totalStatus = 0;
        foreach ($detailRequests as $detailRequest) {
            if ($detailRequest->status == 'accepted') {
                $totalStatus++;
            }

            if ($detailRequests->count() === $totalStatus) {
                return 'taken';
            }

            DetailRequest::whereId($detailRequest->id)
                        ->where('status', 'pending')
                        ->update(['status' => 'accepted', 'dosen_id' => auth()->user()->dosen->id]);

            ModelsRequest::whereId($detailRequest->request_id)
                    ->where('status', 'unfinished')
                    ->update(['status' => 'processed']);
        }

        return 'success';
    }

    public function receive_show(ModelsRequest $id)
    {

        $detailRequests = DetailRequest::join('requests', 'requests.id', '=', 'detail_requests.request_id')
                                    ->select('requests.id', 'detail_requests.surat_id')
                                    ->whereIn('request_id', $id)
                                    ->where('detail_requests.status', 'pending')
                                    ->get();

        return view('admin.receive.data-receive-modal')->with([
            'receives' => $detailRequests
        ]);
    }

    public function assive_reject($id)
    {
        ModelsRequest::whereId($id)->update(['status' => 'rejected']);
        DetailRequest::where('request_id', $id)->update(['status' => 'rejected']);

        return true;
    }

    public function assignment_index()
    {
        return view('admin.assignment.index')->with([
            'title' => 'Permintaan',
            'subtitle' => 'Permintaan'
        ]);
    }

    public function assignment_read(Request $request)
    {

        if ($request->search === 'default') {
            return view('admin.assignment.data')->with([
                'assigns' => ModelsRequest::select('requests.user_id', 'requests.id', ModelsRequest::raw('max(requests.created_at) as date'), 'detail_requests.status')
                                        ->join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                        ->where('detail_requests.status', '!=', 'pending')
                                        ->where('detail_requests.status', '!=', 'canceled')
                                        ->where('detail_requests.dosen_id', auth()->user()->dosen->id)
                                        ->groupBy('requests.id')
                                        ->groupBy('detail_requests.status')
                                        ->get()
            ]);
        }

        $requests = ModelsRequest::select('requests.mahasiswa_id', ModelsRequest::raw('max(requests.created_at) as date'), 'detail_requests.status')
                            ->join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                            ->join('mahasiswas', 'requests.mahasiswa_id', '=', 'mahasiswas.id')
                            ->whereIn('detail_requests.surat_id', $data)
                            ->where('requests.status', '!=','unfinished')
                            ->where('requests.status', '!=', 'canceled')
                            ->where('detail_requests.dosen_id', auth()->user()->dosen->id)
                            ->whereIn('mahasiswas.id', function($query) use ($request){
                                $query->select('id')
                                    ->from('mahasiswas')
                                    ->where('name', 'LIKE', '%'.$request->search.'%')
                                    ->orWhere('npm', 'LIKE', '%'.$request->search.'%')
                                    ->orWhere('email', 'LIKE', '%'.$request->search.'%')
                                    ->orWhere('phone', 'LIKE', '%'.$request->search.'%');
                            })
                            ->groupBy('requests.id')
                            ->groupBy('detail_requests.status')
                            ->get();

        if ($requests->count() == 0 || $request->search == null) {
            return view('admin.assignment.data')->with([
                'assigns' => ModelsRequest::select('requests.mahasiswa_id', 'requests.id', ModelsRequest::raw('max(requests.created_at) as date'), 'detail_requests.status')
                                        ->join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                        ->whereIn('detail_requests.surat_id', $data)
                                        ->where('detail_requests.status', '!=', 'pending')
                                        ->where('detail_requests.status', '!=', 'canceled')
                                        ->where('detail_requests.dosen_id', auth()->user()->dosen->id)
                                        ->groupBy('requests.id')
                                        ->groupBy('detail_requests.status')
                                        ->get()
            ]);
        }

        return view('admin.assignment.data')->with([
            'assigns' => $requests
        ]);
    }
}
