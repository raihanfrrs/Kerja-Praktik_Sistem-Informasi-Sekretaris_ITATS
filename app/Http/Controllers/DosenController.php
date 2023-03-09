<?php

namespace App\Http\Controllers;

use App\Models\DetailRequest;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function receive_index()
    {
        return view('dosen.receive.index');
    }

    public function receive_read(Request $request)
    {
        $dosens = Dosen::select('surats.id')
                    ->join('job_dosens', 'dosens.id', '=', 'job_dosens.dosen_id')
                    ->join('job_roles', 'job_dosens.role_id', '=', 'job_roles.role_id')
                    ->join('surats', 'job_roles.jenis_surat_id', '=', 'surats.jenis_surat_id')
                    ->where('dosens.id', auth()->user()->dosen->id)
                    ->groupBy('surats.id')
                    ->get();

        foreach ($dosens as $dosen) {
            $data[] = $dosen->id;
        }

        if ($request->search === 'default') {
            return view('dosen.receive.data')->with([
                'receives' => ModelsRequest::select('requests.mahasiswa_id', ModelsRequest::raw('max(requests.created_at) as date'), ModelsRequest::raw('COUNT(*) as amount'))
                                        ->join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                        ->whereIn('detail_requests.surat_id', $data)
                                        ->where('requests.status', '!=','finished')
                                        ->where('requests.status', '!=','rejected')
                                        ->where('detail_requests.status', 'pending')
                                        ->groupBy('requests.mahasiswa_id')
                                        ->get()
            ]);
        }

        $requests = ModelsRequest::select('requests.mahasiswa_id', ModelsRequest::raw('max(requests.created_at) as date'), ModelsRequest::raw('COUNT(*) as amount'))
                            ->join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                            ->join('mahasiswas', 'requests.mahasiswa_id', '=', 'mahasiswas.id')
                            ->whereIn('detail_requests.surat_id', $data)
                            ->where('requests.status', '!=','finished')
                            ->where('requests.status', '!=','rejected')
                            ->where('detail_requests.status', 'pending')
                            ->where('mahasiswas.name', 'LIKE', '%'.$request->search.'%')
                            ->orWhere('mahasiswas.phone', 'LIKE', '%'.$request->search.'%')
                            ->orWhere('mahasiswas.email', 'LIKE', '%'.$request->search.'%')
                            ->groupBy('requests.mahasiswa_id')
                            ->get();

        if ($requests->count() == 0) {
            return view('dosen.receive.data')->with([
                'receives' => ModelsRequest::select('requests.mahasiswa_id', ModelsRequest::raw('max(requests.created_at) as date'), ModelsRequest::raw('COUNT(*) as amount'))
                                        ->join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                        ->whereIn('detail_requests.surat_id', $data)
                                        ->where('requests.status', '!=','finished')
                                        ->where('requests.status', '!=','rejected')
                                        ->where('detail_requests.status', 'pending')
                                        ->groupBy('requests.mahasiswa_id')
                                        ->get()
            ]);
        }

        return view('dosen.receive.data')->with([
            'receives' => $requests
        ]);
    }

    public function receive_store(Request $request)
    {
        //ada kasus mahasiswa request surat csr dan sekjur, dosen a hanya punya jabatan csr dan dosen b punya jabatan csr dan sekjur. harus membuatkan filter untuk masing" jabatan
        $mahasiswa = Mahasiswa::where('slug', $request->slug)->first();
        if (ModelsRequest::where('mahasiswa_id', $mahasiswa->id)->where('status', 'finished')->count() > 0) {
            return 'finished';
        }

        // if (ModelsRequest::where('mahasiswa_id', $mahasiswa->id)->where('status', 'rejected')->count() > 0) {
        //     return 'finished';
        // }

        $dosens = Dosen::select('surats.id')
                    ->join('job_dosens', 'dosens.id', '=', 'job_dosens.dosen_id')
                    ->join('job_roles', 'job_dosens.role_id', '=', 'job_roles.role_id')
                    ->join('surats', 'job_roles.jenis_surat_id', '=', 'surats.jenis_surat_id')
                    ->where('dosens.id', auth()->user()->dosen->id)
                    ->groupBy('surats.id')
                    ->get();

        foreach ($dosens as $dosen) {
            $dataDosen[] = $dosen->id;
        }

        $detailRequests =  DetailRequest::select('detail_requests.*')
                                        ->join('requests', 'detail_requests.request_id', '=', 'requests.id')
                                        ->join('mahasiswas', 'requests.mahasiswa_id', '=', 'mahasiswas.id')
                                        ->whereIn('detail_requests.surat_id', $dataDosen)
                                        ->where('requests.mahasiswa_id', $mahasiswa->id)
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

    public function receive_show()
    {
        
    }
}