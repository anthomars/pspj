<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlokPemakaman;
use Yajra\DataTables\Facades\DataTables;

class BlokPemakamanController extends Controller
{
    public function data()
    {
        $data = BlokPemakaman::orderBy('id_blok_pemakaman','desc');

        return DataTables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '
                    <div class="dropdown">
                        <a href="#" class="btn dropdown-toggle" data-bs-toggle="dropdown">Actions</a>
                        <div class="dropdown-menu">
                    ';

                $btn .= '
                    <button data-id="'. $row->id_blok_pemakaman .'"  class="dropdown-item" onclick="detailData('. $row->id_blok_pemakaman .')" data-toggle="tooltip" title="Detail">
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
                    <button data-id="'. $row->id_blok_pemakaman .'"  class="dropdown-item text-danger" onclick="deleteData('. $row->id_blok_pemakaman .')" data-toggle="tooltip" title="Delete">
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
        return view('pages.blok_pemakaman.index');
    }

    public function store(Request $request)
    {
        $rules = [
            'nama_blok_pemakaman'  => 'required|unique:tbl_blok_pemakaman',
            'kapasitas'  => 'required',
            'nama_pic_blok'  => 'required',
            'hp_pic'  => 'required\unique:tbl_blok_pemakaman,hp_pic|regex:/^([0-9\s\-\+\(\)]*)$/|min:8',
        ];
        $message = [
            'nama_blok_pemakaman.required' => 'Nama RT harus di isi.',
            'nama_blok_pemakaman.unique' => 'Blok Sudah digunakan.',
            'kapasitas.required' => 'Kapasitas harus di isi.',
            'nama_pic_blok.required' => 'Nama PIC Blok harus di isi.',
            'hp_pic_blok.required' => 'HP PIC Blok harus di isi.',
            'hp_pic.unique' => 'HP PIC sudah digunakan.',
            'hp_pic.regex' => 'HP PIC harus di isi dengan angka.',
            'hp_pic.min' => 'HP PIC harus di isi minimal 8 Karakter.',
        ];
        $validatedData = $request->validate($rules, $message);

        $create = BlokPemakaman::create($validatedData);

        if($create) {
            return response()->json([
                'status'=>'success',
                'message'=>'Data "'.$create->nama_rw.'" berhasil ditambahkan!'
            ]);
        }
        else {
            return response()->json([
                'status'=>'error',
                'message'=>'Data "'.$request->nama_rw.'" gagal ditambahkan!'
            ], 400);
        }
    }

    public function show(Request $request, string $id)
    {
        $data['blok'] = BlokPemakaman::where('id_rt', $id)->get();

        if($data['blok']) {
            return response()->json([
                'status' => 'success',
                'data' => $data['blok']
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'title'=>'Gagal!',
                'message'=>'Proses tidak dapat dijalankan.'
            ], 400);
        }
    }

    public function update(Request $request, string $id)
    {
        $dataOld = BlokPemakaman::where('id_rt', $id)->get();
        $rules = [];
        $message = [];

        if($dataOld[0]->nama_blok_pemakaman != $request->nama_blok_pemakaman) {
            $rules['nama_blok_pemakaman'] = 'required';
            $message['nama_blok_pemakaman.required'] = 'nama_blok_pemakaman harus di isi.';
        }
        if($dataOld[0]->kapasitas != $request->kapasitas) {
            $rules['kapasitas'] = 'required';
            $message['kapasitas.required'] = 'kapasitas harus di isi.';
        }
        if($dataOld[0]->nama_pic_blok != $request->nama_pic_blok) {
            $rules['nama_pic_blok'] = 'required';
            $message['nama_pic_blok.required'] = 'nama_pic_blok harus di isi.';
        }
        if($dataOld->hp_pic != $request->hp_pic) {
            $rules['hp_pic'] = 'required|unique:tbl_blok_pemakaman,hp_pic';
            $message['hp_pic.required'] = 'HP PIC harus di isi.';
            $message['hp_pic.unique'] = 'HP PIC sudah digunakan.';
        }

        $validatedData = $request->validate($rules, $message);

        if(!$validatedData == NULL) {
            $update = BlokPemakaman::where('id_blok_pemakaman', $dataOld[0]->id_blok_pemakaman)->update($validatedData);
            if($update) {
                $dataNew = BlokPemakaman::where('id_blok_pemakaman', $dataOld[0]->id_blok_pemakaman)->get();
                if ($dataOld[0]->nama_blok_pemakaman != $request->nama_blok_pemakaman) {
                    return response()->json([
                        'status' => 'success',
                        'message'=>'Data "'.$dataNew[0]->nama_blok_pemakaman.'" berhasil diperbarui.<br>Data sebelumnya "'.$dataOld[0]->nama_blok_pemakaman.'".'
                    ]);
                }elseif ($dataOld[0]->kapasitas != $request->kapasitas) {
                    return response()->json([
                        'status' => 'success',
                        'message'=>'Data "'.$dataNew[0]->kapasitas.'" berhasil diperbarui.<br>Data sebelumnya "'.$dataOld[0]->kapasitas.'".'
                    ]);
                }elseif ($dataOld[0]->nama_pic_blok != $request->nama_pic_blok) {
                    return response()->json([
                        'status' => 'success',
                        'message'=>'Data "'.$dataNew[0]->nama_pic_blok.'" berhasil diperbarui.<br>Data sebelumnya "'.$dataOld[0]->nama_pic_blok.'".'
                    ]);
                }elseif ($dataOld[0]->hp_pic != $request->hp_pic) {
                    return response()->json([
                        'status' => 'success',
                        'message'=>'Data "'.$dataNew[0]->hp_pic.'" berhasil diperbarui.<br>Data sebelumnya "'.$dataOld[0]->hp_pic.'".'
                    ]);
                }else {
                    return response()->json([
                        'status' => 'success',
                        'message'=>'Data berhasil diperbarui.'
                    ]);
                }
            }
            else {
                return response()->json([
                    'status' => 'error',
                    'message'=>'Data "'.$dataOld[0]->nama_blok_pemakaman.'" gagal diperbarui!'
                ], 400);
            }
        } else {
            return response()->json([
                'status' => 'info',
                'message'=>'Tidak ada data yang diubah!'
            ]);
        }
    }

    public function destroy(Request $request, string $id)
    {

        $oldData = BlokPemakaman::where('id_blok_pemakaman', $id)->get();
        $delete = BlokPemakaman::where('id_blok_pemakaman', $id)->delete();


        if($delete) {
            return response()->json([
                'status' => 'success',
                'title' => 'Sukses',
                'message'=>'Data "'.$oldData[0]->nama_blok_pemakaman.'" berhasil dihapus!'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'title' => 'Gagal!',
                'message'=>'Data "'.$oldData[0]->nama_blok_pemakaman.'" gagal dihapus!'
            ], 400);
        }
    }

}
