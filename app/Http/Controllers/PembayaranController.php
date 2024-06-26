<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PembayaranController extends Controller
{
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
            $image->move(public_path('uploads/images'), $imageName);

            $bukti_bayar = $imageName;


        $postData = [
            'iuran_id'          => $iuran_id,
            'tgl_bayar'         => $request->tgl_bayar,
            'metode_bayar'      => $request->metode_bayar,
            'bukti_bayar'       => $bukti_bayar,
        ];

        $pembayaran = \App\Models\Pembayaran::create($postData);
        $statusBayar = 'lunas';
        $updateStatusIuran = \App\Models\Iuran::where('id_iuran', $iuran_id)->update(array('status_bayar' => $statusBayar));

        return response()->json([
            'status' => 'success',
            'message' => 'Simpan berhasil',
            'redirect_url' => route('iuran.detail', $iuran_id)
        ]);

    }
}
