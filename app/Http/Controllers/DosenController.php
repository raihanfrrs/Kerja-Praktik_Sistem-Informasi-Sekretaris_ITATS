<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\TempFile;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\DetailRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Request as ModelsRequest;

class DosenController extends Controller
{

    public function assignment_show(ModelsRequest $request)
    {
        if ($request->status == 'canceled' || $request->status == 'unfinished') {
            return back();
        }

        $getMahasiswaName = ModelsRequest::select('mahasiswas.name')
                                        ->join('mahasiswas', 'requests.mahasiswa_id', '=', 'mahasiswas.id')
                                        ->where('requests.id', $request->id)
                                        ->first();

        return view('dosen.assignment.detail')->with([
            'request' => $request,
            'subtitle' => $getMahasiswaName->name,
            'title' => 'Pengiriman',
            'subtitle' => 'Pengiriman'
        ]);
    }

    public function assignment_detail_read(ModelsRequest $request)
    {
        return view('dosen.assignment.data-detail')->with([
            'request' => $request,
            'detail_requests' => DetailRequest::select('detail_requests.id', 'detail_requests.request_id', 'detail_requests.surat', 'detail_requests.status', 'surats.name', 'jenis_surats.jenis')
                                            ->join('surats', 'detail_requests.surat_id', '=', 'surats.id')
                                            ->join('jenis_surats', 'surats.jenis_surat_id', '=', 'jenis_surats.id')
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