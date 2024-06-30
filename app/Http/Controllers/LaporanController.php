<?php

namespace App\Http\Controllers;

use App\Models\Iuran;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index ()
    {
        $data['iuran'] = Iuran::all();
        $data['iuranPerRw'] = $data['iuran']->groupBy('user.rw.no_rw');
        // $data['iuranPerRt'] = $data['iuranPerRw']->groupBy('user.rt.no_rt');

        // dd($data['iuranPerRw']);
        return view('pages.laporan.index', compact('data'));
    }
}
