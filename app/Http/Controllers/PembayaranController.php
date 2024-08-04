<?php

namespace App\Http\Controllers;

use App\Models\Iuran;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PembayaranController extends Controller
{
    public function getData()
    {
        $currentUser = auth()->user()->id;
        if(auth()->user()->role_id == 5){
            $data = Pembayaran::whereHas('iuran', function ($query) use ($currentUser) {
                $query->where('user_id', $currentUser);
            })->with('iuran')->latest();
        }else{
            $data = Pembayaran::with('iuran')->latest();
        }

        return DataTables::of($data)->addIndexColumn()
            ->addColumn('nama_iuran', function($row) {
                return $row->iuran->nama_iuran;
            })
            ->addColumn('nominal_iuran', function($row) {
                return $row->iuran->nominal_iuran;
            })
            ->addColumn('status_bayar', function($row) {
                return $row->iuran->status_bayar;
            })
            ->addColumn('action', function($row){
                $btn = '
                    <div class="dropdown">
                        <a href="#" class="btn dropdown-toggle" data-bs-toggle="dropdown">Actions</a>
                        <div class="dropdown-menu">
                    ';

                    $btn .= '
                    <a href="'. route('iuran.detail', ['iuran' => $row->iuran_id]) .'" class="dropdown-item" data-toggle="tooltip" title="Detail">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-square-rounded me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 9h.01"></path>
                            <path d="M11 12h1v4h1"></path>
                            <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z"></path>
                        </svg>
                        Detail
                    </a>
                ';


                $btn .= '
                        </div>
                    </div>
                    ';
                return $btn;
            })
            ->rawColumns(['action'])
            ->escapeColumns([])
            ->toJson();
    }


    public function index()
    {
        return view('pages.pembayaran.index');
    }

    public function store(Request $request)
    {
        $iuran_id = $request->iuran_id;
        $rules = [
            'tgl_bayar' => 'required',
            'metode_bayar' => 'required',
            'bukti_bayar' => 'required|image|mimes:png,jpeg,jpg|max:500',
        ];

        $messages = [
            'tgl_bayar.required'    => 'Bidang ini wajib di isi',
            'metode_bayar.required' => 'Bidang ini wajib di isi',
            'bukti_bayar.required'  => 'Bidang ini wajib di isi',
            'bukti_bayar.image'     => 'Format input salah',
            'bukti_bayar.max'       => 'Gambar terlalu besar',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors()
                ], 400);
            }

            $image = $request->file('bukti_bayar');
            $imageName = time(). '_' .rand(1000,9999) .'.'.$image->getClientOriginalExtension();
            // $image->move(public_path('uploads/images'), $imageName);
            $path = $image->storeAs('bukti_bayar', $imageName, 'public');

            // $bukti_bayar = $imageName;


        $postData = [
            'iuran_id'          => $iuran_id,
            'tgl_bayar'         => $request->tgl_bayar,
            'metode_bayar'      => $request->metode_bayar,
            'bukti_bayar'       => $path,
        ];

        $pembayaran = Pembayaran::create($postData);
        $statusBayar = 'menunggu konfirmasi';
        $updateStatusIuran = Iuran::where('id_iuran', $iuran_id)->update(array('status_bayar' => $statusBayar));
        return response()->json([
            'status' => 'success',
            'message' => 'Pembayaran berhasil disimpan',
            'redirect_url' => route('iuran.detail', $iuran_id)
        ]);

    }

    public function confirmPayment(Request $request)
    {
        $id_iuran = $request->iuran_id;
        $statusBayar = 'lunas';
        $updateStatusIuran = Iuran::where('id_iuran', $id_iuran)->update(array('status_bayar' => $statusBayar));

        return response()->json([
            'status' => 'success',
            'message' => 'Pembayaran berhasil diubah',
            'redirect_url' => route('iuran.detail', $id_iuran)
        ]);
    }
}
