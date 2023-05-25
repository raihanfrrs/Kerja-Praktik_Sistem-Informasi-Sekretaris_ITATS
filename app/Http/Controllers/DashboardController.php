<?php

namespace App\Http\Controllers;

use App\Models\DetailRequest;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Request as ModelsRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function daily_admin(Request $request, $data)
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
                $amount_now = Dosen::join('users', 'dosens.user_id', '=', 'users.id')
                                ->whereDay('dosens.created_at', now())
                                ->where('users.level', 'dosen')
                                ->count();
                $amount_yesterday = Dosen::join('users', 'dosens.user_id', '=', 'users.id')
                                        ->whereDay('dosens.created_at', Carbon::yesterday())
                                        ->where('users.level', 'dosen')
                                        ->count();
            }elseif ($request->date === 'month') {
                $amount_now = Dosen::join('users', 'dosens.user_id', '=', 'users.id')
                                ->whereMonth('created_at', now())
                                ->where('users.level', 'dosen')
                                ->count();
                $amount_yesterday = Dosen::join('users', 'dosens.user_id', '=', 'users.id')
                                        ->whereMonth('created_at', Carbon::now()->subMonth()->format('m'))
                                        ->where('users.level', 'dosen')
                                        ->count();
            }elseif ($request->date === 'year') {
                $amount_now = Dosen::join('users', 'dosens.user_id', '=', 'users.id')
                                ->whereYear('created_at', now())
                                ->where('users.level', 'dosen')
                                ->count();
                $amount_yesterday = Dosen::join('users', 'dosens.user_id', '=', 'users._id')
                                        ->whereYear('created_at', Carbon::now()->subYear()->format('y'))
                                        ->where('users.level', 'dosen')
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
                $request = ModelsRequest::select('requests.*')
                                        ->whereDay('requests.created_at', now())
                                        ->limit(5)
                                        ->orderBy('requests.created_at', 'DESC')
                                        ->get();
            }elseif ($request->date === 'month') {
                $request = ModelsRequest::select('requests.*')
                                        ->whereMonth('requests.created_at', now())
                                        ->limit(5)
                                        ->orderBy('requests.created_at', 'DESC')
                                        ->get();
            }elseif ($request->date === 'year') {
                $request = ModelsRequest::select('requests.*')
                                        ->whereYear('requests.created_at', now())
                                        ->limit(5)
                                        ->orderBy('requests.created_at', 'DESC')
                                        ->get();
            }

            return view('superadmin.dashboard.data-dashboard-request-activity')->with([
                'requests' => $request
            ]);
        }elseif ($data === 'request-in') {
            $amount_now = DetailRequest::where('dosen_id', auth()->user()->dosen->id)
                                        ->whereYear('created_at', now())
                                        ->count();
            $amount_yesterday = DetailRequest::where('dosen_id', auth()->user()->dosen->id)
                                            ->whereYear('created_at', Carbon::now()->subYear()->format('y'))
                                            ->count();

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
        }elseif ($data === 'request-out') {
            $amount_now = DetailRequest::whereNotNull('surat')
                                        ->where('dosen_id', auth()->user()->dosen->id)
                                        ->whereYear('updated_at', now())
                                        ->count();
            $amount_yesterday = DetailRequest::whereNotNull('surat')
                                            ->where('dosen_id', auth()->user()->dosen->id)
                                            ->whereYear('updated_at', Carbon::now()->subYear()->format('y'))
                                            ->count();

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
            $amount_now = DetailRequest::where('dosen_id', auth()->user()->dosen->id)
                                        ->where('status', 'rejected')
                                        ->whereYear('created_at', now())
                                        ->count();
            $amount_yesterday = DetailRequest::where('dosen_id', auth()->user()->dosen->id)
                                            ->where('status', 'rejected')
                                            ->whereYear('created_at', Carbon::now()->subYear()->format('y'))
                                            ->count();

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
        }elseif ($data === 'request-recent') {
            return view('admin.dashboard.data-recent-request')->with([
                'requests' => ModelsRequest::select('requests.user_id', 'requests.id', 'requests.created_at')
                                        ->join('detail_requests', 'detail_requests.request_id', '=', 'requests.id')
                                        ->where('dosen_id', auth()->user()->dosen->id)
                                        ->groupBy('requests.id')
                                        ->orderBy('requests.created_at', 'DESC')
                                        ->limit(5)
                                        ->get()
            ]);
        }
    }

    public function daily_user(Request $request, $data){
        $amount_now = 0;
        $amount_yesterday = 0;
        if ($data === 'request-out') {
            if ($request->date === 'day') {
                $amount_now = ModelsRequest::whereDay('created_at', now())
                                            ->where('user_id', auth()->user()->id)
                                            ->count();
                $amount_yesterday = ModelsRequest::whereDay('created_at', Carbon::yesterday())
                                                ->where('user_id', auth()->user()->id)
                                                ->count();
            }elseif ($request->date === 'month') {
                $amount_now = ModelsRequest::whereMonth('created_at', now())
                                            ->where('user_id', auth()->user()->id)
                                            ->count();
                $amount_yesterday = ModelsRequest::whereMonth('created_at', Carbon::now()->subMonth()->format('m'))
                                                ->where('user_id', auth()->user()->id)
                                                ->count();
            }elseif ($request->date === 'year') {
                $amount_now = ModelsRequest::whereYear('created_at', now())
                                            ->where('user_id', auth()->user()->id)
                                            ->count();
                $amount_yesterday = ModelsRequest::whereYear('created_at', Carbon::now()->subYear()->format('y'))
                                                ->where('user_id', auth()->user()->id)
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
                                            ->where('requests.user_id', auth()->user()->id)
                                            ->count();
                $amount_yesterday = ModelsRequest::join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                                ->whereDay('detail_requests.updated_at', Carbon::yesterday())
                                                ->whereNotNull('detail_requests.surat')
                                                ->where('requests.user_id', auth()->user()->id)
                                                ->count();
            }elseif ($request->date === 'month') {
                $amount_now = ModelsRequest::join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                            ->whereMonth('detail_requests.updated_at', now())
                                            ->whereNotNull('detail_requests.surat')
                                            ->where('requests.user_id', auth()->user()->id)
                                            ->count();
                $amount_yesterday = ModelsRequest::join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                                ->whereDay('detail_requests.updated_at', Carbon::now()->subMonth()->format('m'))
                                                ->whereNotNull('detail_requests.surat')
                                                ->where('requests.user_id', auth()->user()->id)
                                                ->count();
            }elseif ($request->date === 'year') {
                $amount_now = ModelsRequest::join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                            ->whereYear('detail_requests.updated_at', now())
                                            ->whereNotNull('detail_requests.surat')
                                            ->where('requests.user_id', auth()->user()->id)
                                            ->count();
                $amount_yesterday = ModelsRequest::join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                                ->whereDay('detail_requests.updated_at', Carbon::now()->subYear()->format('y'))
                                                ->whereNotNull('detail_requests.surat')
                                                ->where('requests.user_id', auth()->user()->id)
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
                                            ->where('requests.user_id', auth()->user()->id)
                                            ->count();
                $amount_yesterday = ModelsRequest::join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                                ->whereDay('detail_requests.updated_at', Carbon::yesterday())
                                                ->where('detail_requests.status', 'reject')
                                                ->where('requests.user_id', auth()->user()->id)
                                                ->count();
            }elseif ($request->date === 'month') {
                $amount_now = ModelsRequest::join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                            ->whereMonth('detail_requests.updated_at', now())
                                            ->where('detail_requests.status', 'reject')
                                            ->where('requests.user_id', auth()->user()->id)
                                            ->count();
                $amount_yesterday = ModelsRequest::join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                                ->whereMonth('detail_requests.updated_at', Carbon::now()->subMonth()->format('m'))
                                                ->where('detail_requests.status', 'reject')
                                                ->where('requests.user_id', auth()->user()->id)
                                                ->count();
            }elseif ($request->date === 'year') {
                $amount_now = ModelsRequest::join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                            ->whereYear('detail_requests.updated_at', now())
                                            ->where('detail_requests.status', 'reject')
                                            ->where('requests.user_id', auth()->user()->id)
                                            ->count();
                $amount_yesterday = ModelsRequest::join('detail_requests', 'requests.id', '=', 'detail_requests.request_id')
                                                ->whereYear('detail_requests.updated_at', Carbon::now()->subYear()->format('y'))
                                                ->where('detail_requests.status', 'reject')
                                                ->where('requests.user_id', auth()->user()->id)
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
        }elseif ($data === 'recent-activity') {
            $activity = ModelsRequest::where('user_id', auth()->user()->id)
                                    ->orderBy('created_at', 'DESC')
                                    ->limit(6)
                                    ->get();

            return view('user.dashboard.data-recent-activity')->with([
                'activities' => $activity
            ]);
        }
    }
}
