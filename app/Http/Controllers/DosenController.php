<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function receive_index()
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

        return view('dosen.receive.index')->with([
            'receives' => ModelsRequest::select('requests.id')
                                    ->join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                    ->whereIn('detail_requests.surat_id', $data)
                                    ->groupBy('requests.id')
                                    ->get()
        ]);
    }
}