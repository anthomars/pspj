<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Iuran;
use App\Models\Jenazah;
use Illuminate\Http\Request;
use App\Models\BlokPemakaman;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data['user']        = User::where('is_active', 1)->count();
        $data['kematian']   = Jenazah::whereMonth('tgl_wafat', Carbon::now()->month)->count();
        $data['blok']       = BlokPemakaman::all();
        $data['iuran_sudah_bayar'] = Iuran::where('status_bayar', 'lunas')->whereMonth('date_created', now()->month)->count();
        $data['iuran_belum_bayar'] = Iuran::where('status_bayar', 'belum lunas')->whereMonth('date_created', now()->month)->count();
        $data['iuran_tuggu_konfirmasi'] = Iuran::where('status_bayar', 'menunggu konfirmasi')->whereMonth('date_created', now()->month)->count();

        return view('pages.dashboard', compact('data'));
    }
}
