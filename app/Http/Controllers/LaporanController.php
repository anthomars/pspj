<?php

namespace App\Http\Controllers;

use App\Models\Iuran;
use App\Models\Pemakaman;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LaporanController extends Controller
{
    public function iuran_bulanan ()
    {
        $data['iuran'] = Iuran::all();
        $data['iuranPerRw'] = $data['iuran']->groupBy(function($item) {
            return $item->user->rw->no_rw; // Group by 'no_rw' of the related 'rw' model
        })->map(function ($items) {
            return $items->groupBy(function($item) {
                return Carbon::parse($item->date_created)->format('Y'); // Group by year of 'date_created'
            });
        });

        return view('pages.laporan.iuran_bulanan', compact('data'));
    }

    public function biaya_pemakaman ()
    {
        $data['pemakaman'] = Pemakaman::all();
        $data['pemakamanPerRw'] = $data['pemakaman']->groupBy(function($item) {
            return $item->jenazah->user->rw->no_rw;
        })->map(function ($items) {
            return $items->groupBy(function($item) {
                return Carbon::parse($item->tgl_bayar)->format('Y'); // Group by year of 'date_created'
            });
        });

        // dd($data['pemakamanPerRw']);
        return view('pages.laporan.biaya_pemakaman', compact('data'));
    }
}
