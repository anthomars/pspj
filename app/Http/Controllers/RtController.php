<?php

namespace App\Http\Controllers;

use App\Models\Rt;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RtController extends Controller
{
    public function data()
    {
        $data = Rt::orderBy('id_rt','desc');

        return DataTables::of($data)->addIndexColumn()
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
        return view('pages.rt.index');
    }

    public function store(Request $request)
    {
        $rules = [
            'nama_rt'  => 'required',
            'no_rt'  => 'required',
            'alamat_rt'  => 'required',
            'rw_id'  => 'required',
        ];
        $message = [
            'nama_rt.required' => 'Nama RT harus di isi.',
            'no_rt.required' => 'No. RT harus di isi.',
            'rw_id.required' => 'RW Id harus di isi.',
        ];
        $validatedData = $request->validate($rules, $message);

        $create = Rt::create($validatedData);

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
        $data['rt'] = Rt::where('id_rt', $id)->get();

        if($data['rt']) {
            return response()->json([
                'status' => 'success',
                'data' => $data['rt']
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
        $dataOld = Rt::where('id_rt', $id)->get();
        // dd($dataOld);
        $rules = [];
        $message = [];

        if($dataOld[0]->nama_rt != $request->nama_rt) {
            $rules['nama_rt'] = 'required';
            $message['nama_rt.required'] = 'nama_rt harus di isi.';
        }
        if($dataOld[0]->no_rt != $request->no_rt) {
            $rules['no_rt'] = 'required';
            $message['no_rt.required'] = 'no_rt harus di isi.';
        }
        if($dataOld[0]->alamat_rt != $request->alamat_rt) {
            $rules['alamat_rt'] = 'required';
            $message['alamat_rt.required'] = 'alamat_rt harus di isi.';
        }

        $validatedData = $request->validate($rules, $message);

        if(!$validatedData == NULL) {
            $update = Rt::where('id_rt', $dataOld[0]->id_rt)->update($validatedData);
            if($update) {
                $dataNew = Rt::where('id_rt', $dataOld[0]->id_rt)->get();
                if ($dataOld[0]->nama_rt != $request->nama_rt) {
                    return response()->json([
                        'status' => 'success',
                        'message'=>'Data "'.$dataNew[0]->nama_rt.'" berhasil diperbarui.<br>Data sebelumnya "'.$dataOld[0]->nama_rt.'".'
                    ]);
                }elseif ($dataOld[0]->no_rt != $request->no_rt) {
                    return response()->json([
                        'status' => 'success',
                        'message'=>'Data "'.$dataNew[0]->no_rt.'" berhasil diperbarui.<br>Data sebelumnya "'.$dataOld[0]->no_rt.'".'
                    ]);
                }elseif ($dataOld[0]->alamat_rt != $request->alamat_rt) {
                    return response()->json([
                        'status' => 'success',
                        'message'=>'Data "'.$dataNew[0]->alamat_rt.'" berhasil diperbarui.<br>Data sebelumnya "'.$dataOld[0]->alamat_rt.'".'
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
                    'message'=>'Data "'.$dataOld[0]->nama_rt.'" gagal diperbarui!'
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

        $oldData = Rt::where('id_rt', $id)->get();
        $delete = Rt::where('id_rt', $id)->delete();


        if($delete) {
            return response()->json([
                'status' => 'success',
                'title' => 'Sukses',
                'message'=>'Data "'.$oldData[0]->nama_rt.'" berhasil dihapus!'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'title' => 'Gagal!',
                'message'=>'Data "'.$oldData[0]->name_rt.'" gagal dihapus!'
            ], 400);
        }
    }

    public function getRt()
    {
        $rt = Rt::all();

        return response()->json([
            'status' => 'success',
            'data' => $rt,
        ]);
    }

}
