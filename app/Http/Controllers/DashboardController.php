<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function daily(Request $request, $data)
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
        }
    }
}
