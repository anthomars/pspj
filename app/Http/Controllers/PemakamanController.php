<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PemakamanController extends Controller
{
    public function data(Request $request)
    {
        $data = \App\Models\Pemakaman::with(['blok'])
            ->orderBy('date_created', 'desc');

        if ($request->has('status_bayar') && !empty($request->status_bayar)) {
            $data->where('status_bayar', $request->status_bayar);
        }

        if ($request->has('blok_pemakaman_id') && !empty($request->blok_pemakaman_id)) {
            $data->where('blok_pemakaman_id', $request->blok_pemakaman_id);
        }

        return DataTables::of($data)->addIndexColumn()
            ->addColumn('nama_blok', function($row) {
                return $row->blok->nama_blok_pemakaman;
            })
            ->addColumn('action', function($row){
                $btn = '
                    <div class="dropdown">
                        <a href="#" class="btn dropdown-toggle" data-bs-toggle="dropdown">Actions</a>
                        <div class="dropdown-menu">
                    ';

                $btn .= '
                    <a href="'. route('makam.edit', ['id' => $row->id]) .'" class="dropdown-item" data-toggle="tooltip" title="Edit">
                        <i class="fa-regular fa-pen-to-square"></i>
                        Edit
                    </a>
                ';
                if(auth()->user()->role_id != 5){

                    $btn .= '
                        <div class="dropdown-divider my-1"></div>
                        <button data-id="'. $row->id .'"  class="dropdown-item text-danger" onclick="deleteData('. $row->id .')" data-toggle="tooltip" title="Delete">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4 7l16 0"></path>
                                <path d="M10 11l0 6"></path>
                                <path d="M14 11l0 6"></path>
                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                            </svg>
                        Delete
                        </button>
                    ';
                }

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
        $blok = \App\Models\BlokPemakaman::get();
        return view('pages.pemakaman.manage', compact('blok'));
    }

    public function create()
    {
        $blok = \App\Models\BlokPemakaman::get();
        return view('pages.pemakaman.create', compact('blok'));
    }

    public function store(Request $request)
    {
        $rules = [
            'blok_pemakaman_id'     => 'required|numeric',
            'status_pemakaman'      => 'required',
           'tgl_pemakaman'          => 'required',
           'jam_pemakaman'          => 'required',
           'nama_biaya'             => 'required|max:100',
           'nominal_biaya'          => 'required|numeric',
           'status_bayar'           => 'required',
        ];

        $messages = [
            'blok_pemakaman_id.required'  => 'Pilih salah satu',
            'status_pemakaman.required'  => 'Pilih salah satu',
            'tgl_pemakaman.required'    => 'Bidang ini wajib di isi',
            'jam_pemakaman.required'    => 'Bidang ini wajib di isi',
            'nama_biaya.required'   => 'Bidang ini wajib di isi',
            'nama_biaya.max'        => 'Maksimal 100 karakter',
            'nominal_biaya.required' => 'Bidang ini wajib di isi',
            'nominal_biaya.numeric' => 'Hanya boleh di isi angka',
            'status_bayar.required' => 'Pilih salah satu',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);


        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 400);
        }

        $currentUser = auth()->user()->username;

        $postData = [
            'blok_pemakaman_id' => $request->blok_pemakaman_id,
            'status_pemakaman' => $request->status_pemakaman,
            'tgl_pemakaman' => $request->tgl_pemakaman,
            'jam_pemakaman' => $request->jam_pemakaman,
            'author_create' => $currentUser,
            'author_update' => $currentUser,
            'date_created' => date('Y-m-d'),
            'nama_biaya'    => $request->nama_biaya,
            'nominal_biaya' => $request->nominal_biaya,
            'status_bayar'  => $request->status_bayar,
        ];

        $iuran = \App\Models\Pemakaman::create($postData);

        return response()->json([
            'status' => 'success',
            'message' => 'Simpan berhasil',
            'redirect_url' => route('makam.index')
        ]);
    }

    public function edit($id)
    {
        $blok = \App\Models\BlokPemakaman::get();
        $makam = \App\Models\Pemakaman::findOrFail($id);
        return view('pages.pemakaman.edit', compact('blok', 'makam'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'blok_pemakaman_id'     => 'required|numeric',
            'status_pemakaman'      => 'required',
           'tgl_pemakaman'          => 'required',
           'jam_pemakaman'          => 'required',
           'nama_biaya'             => 'required|max:100',
           'nominal_biaya'          => 'required|numeric',
           'status_bayar'           => 'required',
        ];

        $messages = [
            'blok_pemakaman_id.required'  => 'Pilih salah satu',
            'status_pemakaman.required'  => 'Pilih salah satu',
            'tgl_pemakaman.required'    => 'Bidang ini wajib di isi',
            'jam_pemakaman.required'    => 'Bidang ini wajib di isi',
            'nama_biaya.required'   => 'Bidang ini wajib di isi',
            'nama_biaya.max'        => 'Maksimal 100 karakter',
            'nominal_biaya.required' => 'Bidang ini wajib di isi',
            'nominal_biaya.numeric' => 'Hanya boleh di isi angka',
            'status_bayar.required' => 'Pilih salah satu',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);


        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 400);
        }

        $currentUser = auth()->user()->username;

        $postData = [
            'blok_pemakaman_id' => $request->blok_pemakaman_id,
            'status_pemakaman' => $request->status_pemakaman,
            'tgl_pemakaman' => $request->tgl_pemakaman,
            'jam_pemakaman' => $request->jam_pemakaman,
            'author_create' => $currentUser,
            'author_update' => $currentUser,
            'date_created' => date('Y-m-d'),
            'nama_biaya'    => $request->nama_biaya,
            'nominal_biaya' => $request->nominal_biaya,
            'status_bayar'  => $request->status_bayar,
        ];

        $iuran = \App\Models\Pemakaman::findOrFail($id)->update($postData);

        return response()->json([
            'status' => 'success',
            'message' => 'Perubahan berhasil disimpan',
            'redirect_url' => route('makam.index')
        ]);

    }

    public function destroy(Request $request, $id)
    {
        $delete = \App\Models\Pemakaman::where('id', $id)->delete();

        if($delete) {
            return response()->json([
                'status' => 'success',
                'title' => 'Sukses',
                'message'=> 'Hapus berhasil'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'title' => 'Gagal!',
                'message'=> 'Gagal saat menghapus data'
            ], 400);
        }
    }

}
