<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class IuranController extends Controller
{

    public function data()
    {
        $data = \App\Models\Iuran::with('jenazah')->orderBy('date_created','desc');

        return DataTables::of($data)->addIndexColumn()
            ->addColumn('nama_jenazah', function($row) {
                return $row->jenazah->nama_jenazah;
            })
            ->addColumn('action', function($row){
                $btn = '
                    <div class="dropdown">
                        <a href="#" class="btn dropdown-toggle" data-bs-toggle="dropdown">Actions</a>
                        <div class="dropdown-menu">
                    ';

                $btn .= '
                    <button data-id="'. $row->id_rt .'"  class="dropdown-item" onclick="detailData('. $row->id_rt .')" data-toggle="tooltip" title="Detail">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-square-rounded me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 9h.01"></path>
                            <path d="M11 12h1v4h1"></path>
                            <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z"></path>
                        </svg>
                        Detail
                    </button>
                ';

                $btn .= '
                    <div class="dropdown-divider my-1"></div>
                    <button data-id="'. $row->id_rt .'"  class="dropdown-item text-danger" onclick="deleteData('. $row->id_rt .')" data-toggle="tooltip" title="Delete">
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
       
        return view('pages.iuran.manage');
    }

    public function create()
    {
        $dataJenazah = \App\Models\Jenazah::get();
        return view('pages.iuran.create', compact('dataJenazah'));
    }

    public function store(Request $request)
    {
        $rules = [
            'jenazah_id' => 'required|numeric|exists:tbl_jenazah,id_jenazah',
            'nama_iuran' => 'required|string|max:100',
            'nominal_iuran' => 'required|numeric',
            'metode_bayar' => 'required',
        ];

        $messages = [
            'jenazah_id.required' => 'Pilih salah satu',
            'jenazah_id.numeric' => 'Format input salah',
            'nama_iuran.required' => 'Bidang ini wajib di isi',
            'nama_iuran.string' => 'Format input salah',
            'nama_iuran.max' => 'Maksimal input 100 karakter',
            'nominal_iuran.required' => 'Bidang ini wajib di isi',
            'nominal_iuran.numeric' => 'Hanya boleh di isi angka',
            'metode_bayar.required' => 'Pilih salah satu',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);


        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 400);
        }

        $postData = [
            'nama_iuran'        => $request->nama_iuran,
            'nominal_iuran'     => $request->nominal_iuran,
            'metode_bayar'      => $request->metode_bayar,
            'date_created'      => date('Y-m-d'),
            'user_id'           => auth()->user()->id,
            'jenazah_id'        => $request->jenazah_id,
        ];

        $iuran = \App\Models\Iuran::create($postData);

        return response()->json([
            'status' => 'success',
            'message' => 'Simpan berhasil',
            'redirect_url' => route('iuran.index') 
        ]);

    }

}

