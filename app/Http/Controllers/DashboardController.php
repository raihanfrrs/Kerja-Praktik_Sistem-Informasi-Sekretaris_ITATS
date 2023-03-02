<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Request as ModelsRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function daily_dosen(Request $request, $data)
    {
        $amount_now = 0;
        $amount_yesterday = 0;
        if ($data === 'mahasiswa') {
            if ($request->date === 'day') {
                $amount_now = Mahasiswa::whereDay('created_at', now())->count();
                $amount_yesterday = Mahasiswa::whereDay('created_at', Carbon::yesterday())->count();
            }elseif ($request->date === 'month') {
                $amount_now = Mahasiswa::whereMonth('created_at', now())->count();
                $amount_yesterday = Mahasiswa::whereMonth('created_at', Carbon::now()->subMonth()->format('m'))->count();
            }elseif ($request->date === 'year') {
                $amount_now = Mahasiswa::whereYear('created_at', now())->count();
                $amount_yesterday = Mahasiswa::whereYear('created_at', Carbon::now()->subYear()->format('y'))->count();
            }

            if ($amount_now == 0 && $amount_yesterday == 0) {
                $amount_yesterday = 1;
            }elseif ($amount_now > 0 && $amount_yesterday == 0) {
                $amount_yesterday = $amount_now;
            }

            $percent = ($amount_now / $amount_yesterday) * 100;

            $data = [
                'amount' => $amount_now,
                'percent' => $percent
            ];

            return $data;
        }elseif ($data === 'dosen') {
            if ($request->date === 'day') {
                $amount_now = Dosen::whereDay('created_at', now())->count();
                $amount_yesterday = Dosen::whereDay('created_at', Carbon::yesterday())->count();
            }elseif ($request->date === 'month') {
                $amount_now = Dosen::whereMonth('created_at', now())->count();
                $amount_yesterday = Dosen::whereMonth('created_at', Carbon::now()->subMonth()->format('m'))->count();
            }elseif ($request->date === 'year') {
                $amount_now = Dosen::whereYear('created_at', now())->count();
                $amount_yesterday = Dosen::whereYear('created_at', Carbon::now()->subYear()->format('y'))->count();
            }

            if ($amount_now == 0 && $amount_yesterday == 0) {
                $amount_yesterday = 1;
            }elseif ($amount_now > 0 && $amount_yesterday == 0) {
                $amount_yesterday = $amount_now;
            }

            $percent = ($amount_now / $amount_yesterday) * 100;

            $data = [
                'amount' => $amount_now,
                'percent' => $percent
            ];

            return $data;
        }elseif ($data === 'request') {
            if ($request->date === 'day') {
                $amount_now = ModelsRequest::whereDay('created_at', now())->count();
                $amount_yesterday = ModelsRequest::whereDay('created_at', Carbon::yesterday())->count();
            }elseif ($request->date === 'month') {
                $amount_now = ModelsRequest::whereMonth('created_at', now())->count();
                $amount_yesterday = ModelsRequest::whereMonth('created_at', Carbon::now()->subMonth()->format('m'))->count();
            }elseif ($request->date === 'year') {
                $amount_now = ModelsRequest::whereYear('created_at', now())->count();
                $amount_yesterday = ModelsRequest::whereYear('created_at', Carbon::now()->subYear()->format('y'))->count();
            }

            if ($amount_now == 0 && $amount_yesterday == 0) {
                $amount_yesterday = 1;
            }elseif ($amount_now > 0 && $amount_yesterday == 0) {
                $amount_yesterday = $amount_now;
            }

            $percent = ($amount_now / $amount_yesterday) * 100;

            $data = [
                'amount' => $amount_now,
                'percent' => $percent
            ];

            return $data;
        }elseif ($data === 'request-activity') {
            if ($request->date === 'day') {
                $request = ModelsRequest::join('mahasiswas', 'requests.mahasiswa_id', '=', 'mahasiswas.id')
                                        ->select('requests.*')
                                        ->whereDay('requests.created_at', now())
                                        ->limit(5)
                                        ->orderBy('requests.created_at', 'DESC')
                                        ->get();
            }elseif ($request->date === 'month') {
                $request = ModelsRequest::join('mahasiswas', 'requests.mahasiswa_id', '=', 'mahasiswas.id')
                                        ->select('requests.*')
                                        ->whereMonth('requests.created_at', now())
                                        ->orderBy('requests.created_at', 'DESC')
                                        ->get();
            }elseif ($request->date === 'year') {
                $request = ModelsRequest::join('mahasiswas', 'requests.mahasiswa_id', '=', 'mahasiswas.id')
                                        ->select('requests.*')
                                        ->whereYear('requests.created_at', now())
                                        ->orderBy('requests.created_at', 'DESC')
                                        ->get();
            }

            return view('superadmin.data-dashboard-request-activity')->with([
                'requests' => $request
            ]);
        }
    }

    public function daily_mahasiswa(Request $request, $data){
        if (auth()->user()->level === 'mahasiswa') {
            $amount_now = 0;
            $amount_yesterday = 0;
            if ($data === 'request-out') {
                if ($request->date === 'day') {
                    $amount_now = ModelsRequest::whereDay('created_at', now())
                                                ->where('mahasiswa_id', auth()->user()->mahasiswa->id)
                                                ->count();
                    $amount_yesterday = ModelsRequest::whereDay('created_at', Carbon::yesterday())
                                                    ->where('mahasiswa_id', auth()->user()->mahasiswa->id)
                                                    ->count();
                }elseif ($request->date === 'month') {
                    $amount_now = ModelsRequest::whereMonth('created_at', now())
                                                ->where('mahasiswa_id', auth()->user()->mahasiswa->id)
                                                ->count();
                    $amount_yesterday = ModelsRequest::whereMonth('created_at', Carbon::now()->subMonth()->format('m'))
                                                    ->where('mahasiswa_id', auth()->user()->mahasiswa->id)
                                                    ->count();
                }elseif ($request->date === 'year') {
                    $amount_now = ModelsRequest::whereYear('created_at', now())
                                                ->where('mahasiswa_id', auth()->user()->mahasiswa->id)
                                                ->count();
                    $amount_yesterday = ModelsRequest::whereYear('created_at', Carbon::now()->subYear()->format('y'))
                                                    ->where('mahasiswa_id', auth()->user()->mahasiswa->id)
                                                    ->count();
                }

                if ($amount_now == 0 && $amount_yesterday == 0) {
                    $amount_yesterday = 1;
                }elseif ($amount_now > 0 && $amount_yesterday == 0) {
                    $amount_yesterday = $amount_now;
                }

                $percent = ($amount_now / $amount_yesterday) * 100;

                $data = [
                    'amount' => $amount_now,
                    'percent' => $percent
                ];

                return $data;
            }elseif ($data === 'request-in') {
                if ($request->date === 'day') {
                    $amount_now = ModelsRequest::join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                                ->whereDay('detail_requests.updated_at', now())
                                                ->whereNotNull('detail_requests.surat')
                                                ->where('requests.mahasiswa_id', auth()->user()->mahasiswa->id)
                                                ->count();
                    $amount_yesterday = ModelsRequest::join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                                    ->whereDay('detail_requests.updated_at', Carbon::yesterday())
                                                    ->whereNotNull('detail_requests.surat')
                                                    ->where('requests.mahasiswa_id', auth()->user()->mahasiswa->id)
                                                    ->count();
                }elseif ($request->date === 'month') {
                    $amount_now = ModelsRequest::join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                                ->whereMonth('detail_requests.updated_at', now())
                                                ->whereNotNull('detail_requests.surat')
                                                ->where('requests.mahasiswa_id', auth()->user()->mahasiswa->id)
                                                ->count();
                    $amount_yesterday = ModelsRequest::join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                                    ->whereDay('detail_requests.updated_at', Carbon::now()->subMonth()->format('m'))
                                                    ->whereNotNull('detail_requests.surat')
                                                    ->where('requests.mahasiswa_id', auth()->user()->mahasiswa->id)
                                                    ->count();
                }elseif ($request->date === 'year') {
                    $amount_now = ModelsRequest::join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                                ->whereYear('detail_requests.updated_at', now())
                                                ->whereNotNull('detail_requests.surat')
                                                ->where('requests.mahasiswa_id', auth()->user()->mahasiswa->id)
                                                ->count();
                    $amount_yesterday = ModelsRequest::join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                                    ->whereDay('detail_requests.updated_at', Carbon::now()->subYear()->format('y'))
                                                    ->whereNotNull('detail_requests.surat')
                                                    ->where('requests.mahasiswa_id', auth()->user()->mahasiswa->id)
                                                    ->count();
                }

                if ($amount_now == 0 && $amount_yesterday == 0) {
                    $amount_yesterday = 1;
                }elseif ($amount_now > 0 && $amount_yesterday == 0) {
                    $amount_yesterday = $amount_now;
                }

                $percent = ($amount_now / $amount_yesterday) * 100;

                $data = [
                    'amount' => $amount_now,
                    'percent' => $percent
                ];

                return $data;
            }elseif ($data === 'request-reject') {
                if ($request->date === 'day') {
                    $amount_now = ModelsRequest::join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                                ->whereDay('detail_requests.updated_at', now())
                                                ->where('detail_requests.status', 'reject')
                                                ->where('requests.mahasiswa_id', auth()->user()->mahasiswa->id)
                                                ->count();
                    $amount_yesterday = ModelsRequest::join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                                    ->whereDay('detail_requests.updated_at', Carbon::yesterday())
                                                    ->where('detail_requests.status', 'reject')
                                                    ->where('requests.mahasiswa_id', auth()->user()->mahasiswa->id)
                                                    ->count();
                }elseif ($request->date === 'month') {
                    $amount_now = ModelsRequest::join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                                ->whereMonth('detail_requests.updated_at', now())
                                                ->where('detail_requests.status', 'reject')
                                                ->where('requests.mahasiswa_id', auth()->user()->mahasiswa->id)
                                                ->count();
                    $amount_yesterday = ModelsRequest::join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                                    ->whereMonth('detail_requests.updated_at', Carbon::now()->subMonth()->format('m'))
                                                    ->where('detail_requests.status', 'reject')
                                                    ->where('requests.mahasiswa_id', auth()->user()->mahasiswa->id)
                                                    ->count();
                }elseif ($request->date === 'year') {
                    $amount_now = ModelsRequest::join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                                ->whereYear('detail_requests.updated_at', now())
                                                ->where('detail_requests.status', 'reject')
                                                ->where('requests.mahasiswa_id', auth()->user()->mahasiswa->id)
                                                ->count();
                    $amount_yesterday = ModelsRequest::join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                                    ->whereYear('detail_requests.updated_at', Carbon::now()->subYear()->format('y'))
                                                    ->where('detail_requests.status', 'reject')
                                                    ->where('requests.mahasiswa_id', auth()->user()->mahasiswa->id)
                                                    ->count();
                }

                if ($amount_now == 0 && $amount_yesterday == 0) {
                    $amount_yesterday = 1;
                }elseif ($amount_now > 0 && $amount_yesterday == 0) {
                    $amount_yesterday = $amount_now;
                }

                $percent = ($amount_now / $amount_yesterday) * 100;

                $data = [
                    'amount' => $amount_now,
                    'percent' => $percent
                ];

                return $data;
            }
        }
    }
}
