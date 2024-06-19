<?php

namespace App\Http\Controllers;

use App\Models\Rw;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RwController extends Controller
{
    public function data()
    {
        $data = Rw::orderBy('id_rw','desc');

        return DataTables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '
                    <div class="dropdown">
                        <a href="#" class="btn dropdown-toggle" data-bs-toggle="dropdown">Actions</a>
                        <div class="dropdown-menu">
                    ';

                $btn .= '
                    <button data-id="'. $row->id .'"  class="dropdown-item" onclick="detailData('. $row->id_rw .')" data-toggle="tooltip" title="Detail">
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
                    <button data-id="'. $row->id .'"  class="dropdown-item text-danger" onclick="deleteData('. $row->id_rw .')" data-toggle="tooltip" title="Delete">
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
        return view('pages.rw.index');
    }

    public function store(Request $request)
    {
        $rules = [
            'nama_rw'  => 'required',
            'no_rw'  => 'required',
            'alamat_rw'  => 'required',
        ];
        $message = [
            'nama_rw.required' => 'Nama RW harus di isi.',
            'no_rw.required' => 'No. RW harus di isi.',
            'alamat_rw.required' => 'Alamat RW harus di isi.',
        ];
        $validatedData = $request->validate($rules, $message);

        $create = Rw::create($validatedData);

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
        $data['rw'] = Rw::where('id_rw', $id)->get();

        if($data['rw']) {
            return response()->json([
                'status' => 'success',
                'data' => $data['rw']
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
        // dd($request->all(), $id);
        $dataOld = Rw::where('id_rw', $id)->get();
        // dd($dataOld);
        $rules = [];
        $message = [];

        if($dataOld[0]->nama_rw != $request->nama_rw) {
            $rules['nama_rw'] = 'required';
            $message['nama_rw.required'] = 'nama_rw harus di isi.';
        }
        if($dataOld[0]->no_rw != $request->no_rw) {
            $rules['no_rw'] = 'required';
            $message['no_rw.required'] = 'no_rw harus di isi.';
        }
        if($dataOld[0]->alamat_rw != $request->alamat_rw) {
            $rules['alamat_rw'] = 'required';
            $message['alamat_rw.required'] = 'alamat_rw harus di isi.';
        }

        $validatedData = $request->validate($rules, $message);

        if(!$validatedData == NULL) {
            $update = Rw::where('id_rw', $dataOld[0]->id_rw)->update($validatedData);
            if($update) {
                $dataNew = Rw::where('id_rw', $dataOld[0]->id_rw)->get();
                if ($dataOld[0]->nama_rw != $request->nama_rw) {
                    return response()->json([
                        'status' => 'success',
                        'message'=>'Data "'.$dataNew[0]->nama_rw.'" berhasil diperbarui.<br>Data sebelumnya "'.$dataOld[0]->nama_rw.'".'
                    ]);
                }elseif ($dataOld[0]->no_rw != $request->no_rw) {
                    return response()->json([
                        'status' => 'success',
                        'message'=>'Data "'.$dataNew[0]->no_rw.'" berhasil diperbarui.<br>Data sebelumnya "'.$dataOld[0]->no_rw.'".'
                    ]);
                }elseif ($dataOld[0]->alamat_rw != $request->alamat_rw) {
                    return response()->json([
                        'status' => 'success',
                        'message'=>'Data "'.$dataNew[0]->alamat_rw.'" berhasil diperbarui.<br>Data sebelumnya "'.$dataOld[0]->alamat_rw.'".'
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
                    'message'=>'Data "'.$dataOld[0]->name.'" gagal diperbarui!'
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

        $oldData = Rw::find($id);
        $delete = Rw::destroy($id);

        if($delete) {
            return response()->json([
                'status' => 'success',
                'title' => 'Sukses',
                'message'=>'Data "'.$oldData->name.'" berhasil dihapus!'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'title' => 'Gagal!',
                'message'=>'Data "'.$oldData->name.'" gagal dihapus!'
            ], 400);
        }
    }

}
