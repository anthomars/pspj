<?php

namespace App\Http\Controllers;

use App\Models\Rw;
use App\Models\Iuran;
use App\Models\Pemakaman;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LaporanController extends Controller
{
    public function iuran_bulanan (Request $request)
    {
        $data['RW'] = Rw::all();

        $data['iuran'] = Iuran::all();
        if ($request->has('rw') && !empty($request->rw)) {
            $data['iuran'] = Iuran::whereHas('user', function ($query) use ($request) {
                $query->where('rw_id', $request->rw);
            })->get();
        }

        if ($request->has('year') && !empty($request->year)) {
            $data['iuran'] = Iuran::whereYear('date_created', $request->year)->get();
        }

        $data['iuranPerRw'] = $data['iuran']->groupBy(function ($item) {
            return $item->user->rw->no_rw; // Group by 'no_rw' of the related 'rw' model
        })->map(function ($items) {
            return $items->groupBy(function ($item) {
                return Carbon::parse($item->date_created)->format('Y'); // Group by year of 'date_created'
            });
        });

        return view('pages.laporan.iuran_bulanan', compact('data'));
    }

    public function biaya_pemakaman (Request $request)
    {
        $data['RW'] = Rw::all();

        $data['pemakaman'] = Pemakaman::all();

        if ($request->has('rw') && !empty($request->rw)) {
            $data['pemakaman'] = Pemakaman::whereHas('jenazah.user', function ($query) use ($request) {
                $query->where('rw_id', $request->rw);
            })->get();
        }

        if ($request->has('year') && !empty($request->year)) {
            $data['pemakaman'] = Pemakaman::whereYear('date_created', $request->year)->get();
        }

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
