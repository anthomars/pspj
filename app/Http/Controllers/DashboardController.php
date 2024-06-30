<?php

namespace App\Http\Controllers;

use App\Models\Jenazah;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data['kematian'] = Jenazah::whereMonth('tgl_wafat', Carbon::now()->month)->count();

        return view('pages.dashboard', compact('data'));
    }
}
