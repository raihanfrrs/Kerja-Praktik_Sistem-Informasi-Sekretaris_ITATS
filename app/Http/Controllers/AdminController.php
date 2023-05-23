<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\TempFile;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\DetailRequest;
use Illuminate\Support\Facades\Storage;
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

        DetailRequest::where('request_id', $request->id)
                    ->where('status', 'pending')
                    ->update(['status' => 'accepted', 'dosen_id' => auth()->user()->dosen->id]);

        ModelsRequest::whereId($request->id)
                ->where('status', 'unfinished')
                ->update(['status' => 'processed']);

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

        $requests = ModelsRequest::select('requests.user_id', ModelsRequest::raw('max(requests.created_at) as date'), 'detail_requests.status')
                            ->join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
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
                            ->whereIn('dosens.id', function($query) use ($request){
                                $query->select('id')
                                    ->from('dosens')
                                    ->where('name', 'LIKE', '%'.$request->search.'%')
                                    ->orWhere('nip', 'LIKE', '%'.$request->search.'%')
                                    ->orWhere('email', 'LIKE', '%'.$request->search.'%')
                                    ->orWhere('phone', 'LIKE', '%'.$request->search.'%');
                            })
                            ->groupBy('requests.id')
                            ->groupBy('detail_requests.status')
                            ->get();

        if ($requests->count() == 0 || $request->search == null) {
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

        return view('admin.assignment.data')->with([
            'assigns' => $requests
        ]);
    }

    public function assignment_show(ModelsRequest $request)
    {
        if ($request->status == 'canceled' || $request->status == 'unfinished') {
            return back();
        }

        if ($request->user->level === 'mahasiswa') {
            $name = $request->user->mahasiswa->name;
        }elseif ($request->user->level === 'dosen') {
            $name = $request->user->dosen->name;
        }

        return view('admin.assignment.detail')->with([
            'request' => $request,
            'subtitle' => $name,
            'title' => 'Pengiriman',
            'subtitle' => 'Pengiriman'
        ]);
    }

    public function assignment_detail_read(ModelsRequest $request)
    {
        return view('admin.assignment.data-detail')->with([
            'request' => $request,
            'detail_requests' => DetailRequest::select('detail_requests.*')
                                            ->where('request_id', $request->id)
                                            ->where('dosen_id', auth()->user()->dosen->id)
                                            ->get()
        ]);
    }

    public function assignment_uploadFile(Request $request)
    {
        if (TempFile::where('detail_request_id', $request->id)->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengunggah file.'
            ], 500);
        }

        if ($request->hasFile('file')) {
            
            $allowedFormats = ['pdf', 'doc', 'docx', 'ppt', 'pptx', 'xlsx', 'xls'];
            $file = $request->file('file');
            $extension = strtolower($file->getClientOriginalExtension());
            if (!in_array($extension, $allowedFormats)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Format file tidak sesuai. Format yang diizinkan: ' . implode(', ', $allowedFormats)
                ], 500);
            }

            // Validasi ukuran file
            $maxSizeInMb = 2;
            $fileSizeInMb = $file->getSize() / 1024 / 1024; // konversi ke MB
            if ($fileSizeInMb > $maxSizeInMb) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ukuran file melebihi batas maksimum ' . $maxSizeInMb . ' MB.'
                ], 500);
            }
        
            // Proses upload file jika formatnya sesuai
            $folder = uniqid('post', true);
            $file_name = $file->store('posts/' . $folder);
        
            TempFile::create([
                'detail_request_id' => $request->id,
                'file' => $file_name,
                'folder' => $folder
            ]);
        }
    }

    public function assignment_store($id)
    {
        $getDetailRequests = DetailRequest::where('request_id', $id)
                                        ->where('dosen_id', auth()->user()->dosen->id)
                                        ->get();

        foreach ($getDetailRequests as $detailRequests) {
            $detailRequest[] = $detailRequests->id;
        }

        $getTempFiles = TempFile::whereIn('detail_request_id', $detailRequest)->get();

        if ($getTempFiles->count() === 0) {
            return redirect('assignment/'.$id)->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'error',
                'message' => 'Gagal Mengunggah!'
            ]);
        }
        
        foreach ($getTempFiles as $tempFiles) {
            DetailRequest::whereId($tempFiles->detail_request_id)->update(['surat' => $tempFiles->file, 'status' => 'done']);
            TempFile::where('detail_request_id', $tempFiles->detail_request_id)->delete();
        }

        $checkRequests = ModelsRequest::select('requests.id')
                                    ->join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                    ->where('requests.id', $id)
                                    ->where('requests.status', 'processed')
                                    ->get();

        foreach ($checkRequests as $checkRequest) {
            $countRequest = ModelsRequest::join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                        ->where('detail_requests.request_id', $checkRequest->id)
                                        ->where('requests.status', 'processed')
                                        ->count();

            $countDoneDetailRequest = DetailRequest::where('request_id', $checkRequest->id)
                                            ->where('status', 'done')
                                            ->count();

            $countRejectedDoneDetailRequest = DetailRequest::where('request_id', $checkRequest->id)
                                                        ->whereIn('status', ['rejected', 'done'])
                                                        ->count();

            if ($countRequest == $countDoneDetailRequest) {
                ModelsRequest::whereId($checkRequest->id)->update(['status' => 'finished']);
            }elseif ($countRequest == $countRejectedDoneDetailRequest) {
                ModelsRequest::whereId($checkRequest->id)->update(['status' => 'finished']);
            }
        }

        return redirect('assignment/'.$id)->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Berhasil Mengunggah!'
        ]);
    }

    public function assignment_delete(ModelsRequest $request)
    {
        $getDetailRequests = DetailRequest::where('request_id', $request->id)->get();

        foreach ($getDetailRequests as $detailRequest) {
            $dataDetailRequests[] = $detailRequest->id;
        }

        $getTempFiles = TempFile::whereIn('detail_request_id', $dataDetailRequests)->get();

        foreach ($getTempFiles as $tempFiles) {
            Storage::delete($tempFiles->file);
            Storage::deleteDirectory('posts/'.$tempFiles->folder);
            TempFile::whereId($tempFiles->id)->delete();
        }

        return redirect('assignment/'.$request->id)->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Berhasil Membatalkan Pengiriman Surat!'
        ]);
    }
}
