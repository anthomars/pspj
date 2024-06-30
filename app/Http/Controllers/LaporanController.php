<?php

namespace App\Http\Controllers;

use App\Models\Iuran;
use App\Models\Pemakaman;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function iuran_bulanan ()
    {
        $data['iuran'] = Iuran::all();
        $data['iuranPerRw'] = $data['iuran']->groupBy(function($item) {
            return $item->user->rw->no_rw;
        });

        return view('pages.laporan.iuran_bulanan', compact('data'));
    }

    public function biaya_pemakaman ()
    {
        $data['pemakaman'] = Pemakaman::all();
        $data['pemakamanPerRw'] = $data['pemakaman']->groupBy(function($item) {
            return $item->jenazah->user->rw->no_rw;
        });

        // dd($data['pemakamanPerRw']);
        return view('pages.laporan.biaya_pemakaman', compact('data'));
    }
}
