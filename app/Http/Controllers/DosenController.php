<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\TempFile;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\DetailRequest;
use App\Models\Request as ModelsRequest;

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
                'receives' => ModelsRequest::select('requests.mahasiswa_id', ModelsRequest::raw('max(requests.created_at) as date'))
                                        ->join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                        ->whereIn('detail_requests.surat_id', $data)
                                        ->where('requests.status', '!=','finished')
                                        ->where('requests.status', '!=','rejected')
                                        ->where('detail_requests.status', 'pending')
                                        ->groupBy('requests.mahasiswa_id')
                                        ->get()
            ]);
        }

        $requests = ModelsRequest::select('requests.mahasiswa_id', ModelsRequest::raw('max(requests.created_at) as date'))
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
                'receives' => ModelsRequest::select('requests.mahasiswa_id', ModelsRequest::raw('max(requests.created_at) as date'))
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
        $mahasiswa = Mahasiswa::where('slug', $request->slug)->first();
        if (ModelsRequest::where('mahasiswa_id', $mahasiswa->id)->where('status', 'finished')->count() > 0) {
            return 'finished';
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

    public function receive_show($slug)
    {
        $mahasiswa = Mahasiswa::where('slug', $slug)->first();

        $modelsRequests = ModelsRequest::where('mahasiswa_id', $mahasiswa->id)
                                    ->get();

        foreach ($modelsRequests as $request) {
            $requests[] = $request->id;
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

        $detailRequests = DetailRequest::join('requests', 'requests.id', '=', 'detail_requests.request_id')
                                    ->join('mahasiswas', 'requests.mahasiswa_id', '=', 'mahasiswas.id')
                                    ->select('mahasiswas.slug', 'detail_requests.surat_id')
                                    ->whereIn('request_id', $requests)
                                    ->whereIn('surat_id', $dataDosen)
                                    ->where('detail_requests.status', 'pending')
                                    ->get();

        return view('dosen.receive.data-receive-modal')->with([
            'receives' => $detailRequests
        ]);
    }

    public function assive_reject($slug)
    {
        $mahasiswa = Mahasiswa::where('slug', $slug)->first();

        $modelsRequests = ModelsRequest::where('mahasiswa_id', $mahasiswa->id)
                                        ->whereIn('status', ['unfinished', 'processed'])
                                        ->get();

        foreach ($modelsRequests as $request) {
            $requests[] = $request->id;
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
        
        $detailRequests = DetailRequest::select('requests.id', 'detail_requests.surat_id', 'detail_requests.status', 'detail_requests.dosen_id')
                                    ->join('requests', 'requests.id', '=', 'detail_requests.request_id')
                                    ->whereIn('request_id', $requests)
                                    ->whereIn('surat_id', $dataDosen)
                                    ->whereIn('detail_requests.status', ['pending', 'accepted'])
                                    ->get();

        foreach ($detailRequests as $detailRequest) {
            $updateDetailRequest = DetailRequest::where('request_id', $detailRequest->id)
                                                ->where('surat_id', $detailRequest->surat_id)
                                                ->whereIn('status', ['pending', 'accepted'])
                                                ->whereNull('dosen_id')
                                                ->update(['status' => 'rejected', 'dosen_id' => auth()->user()->dosen->id]);

            if (!$updateDetailRequest) {
                DetailRequest::where('request_id', $detailRequest->id)
                                                ->where('surat_id', $detailRequest->surat_id)
                                                ->whereIn('status', ['pending', 'accepted'])
                                                ->where('dosen_id', auth()->user()->dosen->id)
                                                ->whereNotNull('dosen_id')
                                                ->update(['status' => 'rejected']);
            }
        }

        $checkRequests = ModelsRequest::select('requests.id')
                                    ->join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                    ->where('requests.mahasiswa_id', $mahasiswa->id)
                                    ->whereIn('requests.status', ['unfinished', 'processed'])
                                    ->get();

        foreach ($checkRequests as $checkRequest) {
            $countRequest = ModelsRequest::join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                        ->where('detail_requests.request_id', $checkRequest->id)
                                        ->whereIn('requests.status', ['unfinished', 'processed'])
                                        ->count();

            $countDetailRequest = DetailRequest::where('request_id', $checkRequest->id)
                                            ->where('status', 'rejected')
                                            ->count();

            if ($countRequest == $countDetailRequest) {
                ModelsRequest::whereId($checkRequest->id)->update(['status' => 'rejected']);
            }
        }

        return true;
    }

    public function assignment_index()
    {
        return view('dosen.assignment.index');
    }

    public function assignment_read(Request $request)
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
            return view('dosen.assignment.data')->with([
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

        $requests = ModelsRequest::select('requests.mahasiswa_id', ModelsRequest::raw('max(requests.created_at) as date'), 'detail_requests.status')
                            ->join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                            ->join('mahasiswas', 'requests.mahasiswa_id', '=', 'mahasiswas.id')
                            ->whereIn('detail_requests.surat_id', $data)
                            ->where('requests.status', '!=','unfinished')
                            ->where('requests.status', '!=', 'canceled')
                            ->where('mahasiswas.name', 'LIKE', '%'.$request->search.'%')
                            ->orWhere('mahasiswas.phone', 'LIKE', '%'.$request->search.'%')
                            ->orWhere('mahasiswas.email', 'LIKE', '%'.$request->search.'%')
                            ->groupBy('requests.id')
                            ->groupBy('detail_requests.status')
                            ->get();

        if ($requests->count() == 0) {
            return view('dosen.assignment.data')->with([
                'assigns' => ModelsRequest::select('requests.mahasiswa_id', ModelsRequest::raw('max(requests.created_at) as date'), 'detail_requests.status')
                                        ->join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                        ->whereIn('detail_requests.surat_id', $data)
                                        ->where('requests.status', '!=','unfinished')
                                        ->where('requests.status', '!=', 'canceled')
                                        ->groupBy('requests.id')
                                        ->groupBy('detail_requests.status')
                                        ->get()
            ]);
        }

        return view('dosen.assignment.data')->with([
            'assigns' => $requests
        ]);
    }

    public function assignment_show($id)
    {
        return view('dosen.assignment.detail');
    }

    public function assignment_uploadFile(Request $request, $id)
    {
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $file_name = $image->getClientOriginalName();
            $folder = uniqid('post', true);
            $image->store('posts/tmp/' . $folder);

            TempFile::create([
                'folder' => $folder,
                'file' => $file_name
            ]);

            return $folder;
        }

        return false;
    }

    public function assignment_store(Request $request)
    {
        dd($request);
    }

    public function assignment_destroy(Request $request)
    {

    }
}