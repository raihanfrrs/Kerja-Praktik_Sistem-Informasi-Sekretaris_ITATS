<?php

namespace App\Http\Controllers;

use App\Models\DetailRequest;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Request as ModelsRequest;
use Illuminate\Database\Eloquent\Builder;
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
                                        ->where('requests.status', 'unfinished')
                                        ->where('detail_requests.status', 'pending')
                                        ->groupBy('requests.mahasiswa_id')
                                        ->get()
            ]);
        }

        // $surat = Surat::where('status', 'active')->orderBy('id', 'ASC')
        //                 ->where('name', 'LIKE', '%'.$request->search.'%')
        //                 ->orWhere('description', 'LIKE', '%'.$request->search.'%')
        //                 ->get();

        // if ($surat->count() == 0) {
        //     return view('mahasiswa.request.data')->with([
        //         'surats' => Surat::where('status', 'active')->orderBy('id', 'ASC')->get()
        //     ]);
        // }

        // return view('mahasiswa.request.data')->with([
        //     'surats' => $surat
        // ]);
    }

    public function receive_store(Request $request)
    {
        //ada kasus mahasiswa request surat csr dan sekjur, dosen a hanya punya jabatan csr dan dosen b punya jabatan csr dan sekjur. harus membuatkan filter untuk masing" jabatan
        $mahasiswa = Mahasiswa::where('slug', $request->slug)->first();
        if (ModelsRequest::where('mahasiswa_id', $mahasiswa->id)->where('status', 'finished')->count() > 0) {
            return false;
        }

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
            if ($detailRequest->status == 'accept') {
                $totalStatus++;
            }

            if ($detailRequests->count() === $totalStatus) {
                return false;
            }

            DetailRequest::whereId($detailRequest->id)
                        ->where('status', 'pending')
                        ->update(['status' => 'accept', 'dosen_id' => auth()->user()->dosen->id]);
        }

        return true;
    }
}