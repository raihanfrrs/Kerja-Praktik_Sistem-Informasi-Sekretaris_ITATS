<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Broadcast;
use App\Models\DetailBroadcast;
use Illuminate\Http\Request;
use App\Models\TempBroadcast;
use App\Models\TempDosen;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class BroadcastController extends Controller
{
    public function index()
    {
        return view('admin.broadcast.index')->with([
            'title' => 'Penyiaran',
            'subtitle' => 'Penyiaran'
        ]);
    }

    public function readSurat()
    {
        $broadcasts = TempBroadcast::where('user_id', auth()->user()->id)->get();

        if ($broadcasts->count() == 0) {
            return view('admin.broadcast.data-surat')->with([
                'list' => '0'
            ]);
        }elseif ($broadcasts->count() > 0) {
            foreach ($broadcasts as $file) {
                $extension = pathinfo($file->file, PATHINFO_EXTENSION);
    
                $iconMap = [
                    'pdf' => 'pdf.png',
                    'docx' => 'docx.jpg',
                    'doc' => 'doc.jpg',
                    'pptx' => 'pptx.png',
                    'ppt' => 'ppt.png',
                    'xlsx' => 'xlsx.jpg',
                    'xls' => 'xls.jpg',
                ];
                
                $defaultIcon = 'default.png';
                $icon[] = array_key_exists($extension, $iconMap) ? $iconMap[$extension] : $defaultIcon;
            }

            return view('admin.broadcast.data-surat')->with([
                'list' => $broadcasts,
                'icon' => $icon
            ]);
        }
    }

    public function readDosen()
    {
        return view('admin.broadcast.data-dosen')->with([
            'datas' => TempDosen::where('user_id', auth()->user()->id)->get()
        ]);
    }

    public function readBtnSurat()
    {
        return view('admin.broadcast.data-btnSurat')->with([
            'data' => TempBroadcast::where('user_id', auth()->user()->id)->get()
        ]);
    }

    public function readBtnDosen()
    {
        return view('admin.broadcast.data-btnDosen')->with([
            'data' => TempDosen::where('user_id', auth()->user()->id)->get()
        ]);
    }

    public function readBtnSend()
    {
        if (TempBroadcast::where('user_id', auth()->user()->id)->count() > 0 && TempDosen::where('user_id', auth()->user()->id)->count() > 0) {
            return view('admin.broadcast.data-btnSend');
        }
    }

    public function uploadFileRequest(Request $request)
    {
        if ($request->hasFile('files')) {
            
            $allowedFormats = ['pdf', 'doc', 'docx', 'ppt', 'pptx', 'xlsx', 'xls'];
            $file = $request->file('files');
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
            $original_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        
            TempBroadcast::create([
                'user_id' => auth()->user()->id,
                'name' => $original_name,
                'file' => $file_name,
                'folder' => $folder
            ]);
            
            if (TempBroadcast::where('user_id', auth()->user()->id)->count() > 0) {
                $tempBroadcast = TempBroadcast::where('user_id', auth()->user()->id)->get();

                $surat = [];
                $name = [];
                foreach ($tempBroadcast as $value) {
                    $surat[] = $value->file;
                    $name[] = $value->name;
                }

                Broadcast::where('user_id', auth()->user()->id)->where('status', 'unfinished')
                        ->update(['surat' => serialize($surat), 'name' => serialize($name)]);
            }

            return $file_name;
        }
    }

    public function destroy(Request $request)
    {
        TempBroadcast::where('file', $request->file)->delete();

        $broadcast = Broadcast::where('user_id', auth()->user()->id)->where('status', 'unfinished')->first();
        $tempBroadcast = TempBroadcast::where('user_id', auth()->user()->id)->get();

        $surat = [];
        $name = [];
        foreach ($tempBroadcast as $value) {
            $surat[] = $value->file;
            $name[] = $value->name;
        }

        Broadcast::whereId($broadcast->id)
                        ->update(['surat' => serialize($surat), 'name' => serialize($name)]);

        Storage::delete($request->file);
        Storage::deleteDirectory('posts/'.$request->folder);

        if ($tempBroadcast->count() == 0) {
            Broadcast::where('user_id', auth()->user()->id)->where('status', 'unfinished')->delete();
        }

        return "success";
    }

    public function storeDosenData(Request $request)
    {

        if (TempDosen::where('user_id', auth()->user()->id)->whereIn('dosen_id', $request->id)->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Dosen sudah berhasil dipilih!'
            ], 500);
        }

        if (TempBroadcast::where('user_id', auth()->user()->id)->count() === 0) {
            return response()->json([
                'success' => false,
                'message' => 'Tolong upload surat terlebih dahulu sebelum memilih dosen!'
            ], 500);
        }

        foreach ($request->id as $dosen) {
            $data['user_id'] = auth()->user()->id;
            $data['dosen_id'] = $dosen;

            TempDosen::create($data);
        }
    }

    public function resetDosen()
    {
        TempDosen::where('user_id', auth()->user()->id)->delete();
    }

    public function resetSurat()
    {
        TempBroadcast::where('user_id', auth()->user()->id)->delete();
    }

    public function store()
    {
        $tempBroadcast = TempBroadcast::where('user_id', auth()->user()->id)->get();

        $name = [];
        $surat = [];
        foreach ($tempBroadcast as $broadcast) {
            $name[] = $broadcast->name;
            $surat[] = $broadcast->file;
        }

        $broadcast = Broadcast::create([
            'user_id' => auth()->user()->id,
            'name' => serialize($name),
            'surat' => serialize($surat),
            'status' => 'finished'
        ]);

        TempBroadcast::where('user_id', auth()->user()->id)->delete();

        $dosens = TempDosen::where('user_id', auth()->user()->id)->get();

        foreach ($dosens as $dosen) {
            $detailbroadcast['broadcast_id'] = $broadcast->id;
            $detailbroadcast['dosen_id'] = $dosen->dosen_id;

            DetailBroadcast::create($detailbroadcast);
        }

        TempDosen::where('user_id', auth()->user()->id)->delete();
    }

    public function dataListDosen()
    {
        return DataTables::of(Dosen::join('users', 'dosens.user_id', '=', 'users.id')
                                    ->select('dosens.*')
                                    ->where('users.level', 'dosen')
                                    ->where('status', 'active')
                                    ->orderBy('dosens.user_id', 'DESC')
                                    ->get())
        ->addColumn('checkbox', '<input type="checkbox" class="dosens_checkbox" name="dosens_checkbox[]" value="{{$id}}">')
        ->rawColumns(['checkbox'])
        ->make(true);
    }

}
