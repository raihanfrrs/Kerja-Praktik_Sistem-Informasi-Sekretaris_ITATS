<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function daily(Request $request, $data)
    {
        if ($data === 'mahasiswa') {
            if ($request->date === 'day') {
                $amount_now = Mahasiswa::whereDay('created_at', now())->count();
                $amount_yesterday = Mahasiswa::whereDay('created_at', Carbon::yesterday())->count();

                if ($amount_yesterday == 0) {
                    $amount_yesterday = $amount_now;
                }

                $percent = $amount_yesterday / $amount_now * 100;

                $data = [
                    'amount' => $amount_now,
                    'percent' => $percent
                ];

                return $data;
            }elseif ($request->date === 'month'){
                return Mahasiswa::whereMonth('created_at', now())->count();
            }elseif ($request->date === 'year'){
                return Mahasiswa::whereYear('created_at', now())->count();
            }
        }
    }
}
