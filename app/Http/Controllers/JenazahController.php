<?php

namespace App\Http\Controllers;

use App\Models\Jenazah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class JenazahController extends Controller
{
    public function data() {
        $data = Jenazah::orderBy('id_jenazah','ASC');

        return DataTables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){

                $btn = '
                <div class="dropdown">
                    <a href="#" class="btn dropdown-toggle" data-bs-toggle="dropdown">Actions</a>
                    <div class="dropdown-menu">
                ';

                $btn .= '
                <button data-id="'. $row->id_jenazah .'"  class="dropdown-item" onclick="detailData('. $row->id_jenazah .')" data-toggle="tooltip" title="Detail">
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
                    <button data-id="'. $row->id_jenazah .'"  class="dropdown-item text-danger" onclick="deleteData('. $row->id_jenazah .')" data-toggle="tooltip" title="Delete">
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
        return view('pages.jenazah.index');
    }

    public function create()
    {
        return view('pages.jenazah.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'nama_jenazah'  => 'required',
            'tgl_lahir'  => 'required',
            'tgl_wafat'  => 'required',
            'tempat_lahir'  => 'required',
            'tempat_wafat'  => 'required',
            'nik'  => 'required',
            'alamat'  => 'required',
            'keluarga'  => 'required',
        ];
        $message = [
            'nama_jenazah.required' => 'Nama jenazah harus di isi.',
            'tgl_lahir.required' => 'Tanggal lahir harus di isi.',
            'tgl_wafat.required' => 'Tanggal wafat harus di isi.',
            'tempat_lahir.required' => 'Tanggal lahir harus di isi.',
            'tanggal_wafat.required' => 'Tanggal wafat harus di isi.',
            'nik.required' => 'NIK harus di isi.',
            'alamat.required' => 'Alamat harus di isi.',
            'keluarga.required' => 'Keluarga harus di isi.',
        ];
        $validatedData = $request->validate($rules, $message);

        $validatedData['author_create'] = Auth::user()->username;
        $validatedData['author_update'] = Auth::user()->username;
        $validatedData['user_id'] = Auth::user()->id;

        $jenazah = Jenazah::create($validatedData);

        if ($jenazah) {
            Alert::toast('Data "' . $jenazah->nama_jenazah . '" berhasil ditambah!', 'success');
            return redirect('/jenazah');
        } else {
            Alert::toast('Data "' . $jenazah->nama_jenazah . '" gagal ditambah!', 'error');
            return redirect('/jenazah/create');
        }
    }
}
