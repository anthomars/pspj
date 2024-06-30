<?php

namespace App\Http\Controllers;

use App\Models\Jenazah;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class JenazahController extends Controller
{

    public function data() {
        $data = Jenazah::orderBy('id_jenazah','ASC');

        return DataTables::of($data)->addIndexColumn()
            ->addColumn('alamat', function($row) {
                $alamat = '
                    <span class="text-secondary">
                    ' . Str::limit(strip_tags($row->alamat), 10, '<span class="readMore" data-id="'.$row->id_jenazah.'" data-alamat="'.$row->alamat.'" onclick="readMore(this)" style="color:blue; cursor: pointer;"> ... <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevrons-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7l5 5l-5 5" /><path d="M13 7l5 5l-5 5" /></svg></span>') . '
                    </span>
                ';
                return $alamat;
            })
            ->addColumn('action', function($row){

                $btn = '
                <div class="dropdown">
                    <a href="#" class="btn dropdown-toggle" data-bs-toggle="dropdown">Actions</a>
                    <div class="dropdown-menu">
                ';

                $url =('jenazah/'. $row->id_jenazah . '/edit');
                // $btn .= '
                // <button data-id="'. $row->id_jenazah .'"  class="dropdown-item" onclick="detailData('. $row->id_jenazah .')" data-toggle="tooltip" title="Detail">
                //     <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-square-rounded me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                //         <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                //         <path d="M12 9h.01"></path>
                //         <path d="M11 12h1v4h1"></path>
                //         <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z"></path>
                //     </svg>
                //     Detail
                // </button>
                // ';
                $btn .= '
                    <a href="'. $url .'" class="dropdown-item">
                        <svg  xmlns="http://www.w3.org/2000/svg" class="me-1"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                        Edit
                    </a>
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
            ->filterColumn('alamat', function ($query, $keyword) {
                $query->where('alamat', 'like', "%{$keyword}%");
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

    public function edit(Request $request)
    {
        // dd($request->segment(2));
        $jenazah = Jenazah::where('id_jenazah', $request->segment(2))->get();
        // dd($jenazah);
        return view('pages.jenazah.edit', compact('jenazah'));
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $jenazah = Jenazah::where('id_jenazah', $request->segment(2))->get();
        // dd($jenazah);
        $rules = [];
        $message = [];

        if ($jenazah[0]->nama_jenazah != $request->nama_jenazah) {
            $rules['nama_jenazah'] = 'required';
            $message['nama_jenazah.required'] = 'Nama Jenazah harus di isi.';
        }
        if ($jenazah[0]->tgl_lahir != $request->tgl_lahir) {
            $rules['tgl_lahir'] = 'required';
            $message['tgl_lahir.required'] = 'Harus di isi.';
        }
        if ($jenazah[0]->tgl_wafat != $request->tgl_wafat) {
            $rules['tgl_wafat'] = 'required';
            $message['tgl_wafat.required'] = 'Harus di isi.';
        }
        if ($jenazah[0]->tempat_lahir != $request->tempat_lahir) {
            $rules['tempat_lahir'] = 'required';
            $message['tempat_lahir.required'] = 'Harus di isi.';
        }
        if ($jenazah[0]->tempat_wafat != $request->tempat_wafat) {
            $rules['tempat_wafat'] = 'required';
            $message['tempat_wafat.required'] = 'Harus di isi.';
        }
        if ($jenazah[0]->nik != $request->nik) {
            $rules['nik'] = 'required';
            $message['nik.required'] = 'Harus di isi.';
        }
        if ($jenazah[0]->alamat != $request->alamat) {
            $rules['alamat'] = 'required';
            $message['alamat.required'] = 'Harus di isi.';
        }
        if ($jenazah[0]->keluarga != $request->keluarga) {
            $rules['keluarga'] = 'required';
            $message['keluarga.required'] = 'Harus di isi.';
        }

        $validatedData = $request->validate($rules, $message);

        $validatedData['author_update'] = Auth::user()->username;
        $update = Jenazah::where('id_jenazah', $jenazah[0]->id_jenazah)->update($validatedData);
        if ($update) {
            Alert::toast('Data berhasil diperbarui!', 'success');
            return redirect('/jenazah');
        } else {
            Alert::toast('Tidak ada data yang diubah!', 'info');

            return redirect('/jenazah');
        }
    }

    public function destroy(Request $request, string $id)
    {

        $oldData = Jenazah::where('id_jenazah', $id)->get();
        $delete = Jenazah::where('id_jenazah', $id)->delete();


        if($delete) {
            return response()->json([
                'status' => 'success',
                'title' => 'Sukses',
                'message'=>'Data "'.$oldData[0]->nama_jenazah.'" berhasil dihapus!'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'title' => 'Gagal!',
                'message'=>'Data "'.$oldData[0]->nama_jenazah.'" gagal dihapus!'
            ], 400);
        }
    }

    public function getJenazah()
    {
        $rw = \App\Models\Jenazah::all();

        return response()->json([
            'status' => 'success',
            'data' => $rw
        ]);
    }

}
