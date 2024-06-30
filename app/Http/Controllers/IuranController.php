<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Iuran;
use App\Models\Jenazah;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class IuranController extends Controller
{

    public function data()
    {
        $currentUser = auth()->user()->id;
        if(auth()->user()->role_id == 5){
            $data = Iuran::with(['jenazah', 'user'])->where('user_id', $currentUser)->orderBy('date_created','desc');
        }else{
            $data = Iuran::with(['jenazah', 'user'])->orderBy('date_created','desc');
        }

        return DataTables::of($data)->addIndexColumn()
            ->addColumn('nama_jenazah', function($row) {
                return $row->jenazah->nama_jenazah;
            })
            ->addColumn('nama_keluarga', function($row) {
                return $row->user->nama_lengkap;
            })
            ->addColumn('action', function($row){
                $btn = '
                    <div class="dropdown">
                        <a href="#" class="btn dropdown-toggle" data-bs-toggle="dropdown">Actions</a>
                        <div class="dropdown-menu">
                    ';

                    $btn .= '
                    <a href="'. route('iuran.detail', ['iuran' => $row->id_iuran]) .'" class="dropdown-item" data-toggle="tooltip" title="Detail">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-square-rounded me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 9h.01"></path>
                            <path d="M11 12h1v4h1"></path>
                            <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z"></path>
                        </svg>
                        Detail
                    </a>
                ';
                if(auth()->user()->role_id != 5){

                    $btn .= '
                        <div class="dropdown-divider my-1"></div>
                        <button data-id="'. $row->id_iuran .'"  class="dropdown-item text-danger" onclick="deleteData('. $row->id_iuran .')" data-toggle="tooltip" title="Delete">
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

        return view('pages.iuran.manage');
    }

    public function create()
    {
        $dataJenazah = Jenazah::get();
        $warga = User::where('role_id', 5)->get();
        return view('pages.iuran.create', compact('dataJenazah', 'warga'));
    }

    public function store(Request $request)
    {
        $rules = [
            'user_id'   => 'required|numeric|exists:users,id',
            'jenazah_id' => 'required|numeric|exists:tbl_jenazah,id_jenazah',
            'nama_iuran' => 'required|string|max:100',
            'nominal_iuran' => 'required|numeric',
        ];

        $messages = [
            'user_id.required'  => 'Pilih salah satu',
            'jenazah_id.required' => 'Pilih salah satu',
            'jenazah_id.numeric' => 'Format input salah',
            'nama_iuran.required' => 'Bidang ini wajib di isi',
            'nama_iuran.string' => 'Format input salah',
            'nama_iuran.max' => 'Maksimal input 100 karakter',
            'nominal_iuran.required' => 'Bidang ini wajib di isi',
            'nominal_iuran.numeric' => 'Hanya boleh di isi angka',
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
            'date_created'      => date('Y-m-d'),
            'user_id'           => $request->user_id,
            'jenazah_id'        => $request->jenazah_id,
        ];

        $iuran = Iuran::create($postData);

        return response()->json([
            'status' => 'success',
            'message' => 'Simpan berhasil',
            'redirect_url' => route('iuran.index')
        ]);

    }

    public function show($id)
    {
        $iuran = Iuran::with(['jenazah', 'user'])->where('id_iuran', $id)->first();
        $pembayaran = Pembayaran::where('iuran_id', $id)->first();
        return view('pages.iuran.show', compact('iuran', 'pembayaran'));
    }


    public function destroy(Request $request, $id)
    {
        $deleteIuran = Iuran::where('id_iuran', $id)->delete();

        if($deleteIuran) {
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


    /**
     * Running cronjob manual
     */
    public function runCronJob()
    {
        $today = Carbon::today();
        $firstDayOfMonth = $today->firstOfMonth();
        if ($today->eq($firstDayOfMonth)) {
            $this->copyLastInvoices();
            return response()->json([
                'status' => 'success',
                'message' => 'Iuran berhasil dibuat.',
                'redirect_url' => route('iuran.index')
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal membuat iuran',
                'redirect_url' => route('iuran.index')
            ]);
        }
        return view('pages.iuran.manage');
    }

    /**
     * Generate faktur per tgl 01 per bulan secara otomatis
     */
    private function copyLastInvoices()
    {
        // Dapatkan tanggal 01 bulan ini
        $today = Carbon::today();
        $firstDayOfMonth = $today->firstOfMonth();

            if ($today->eq($firstDayOfMonth)) {
                $lastIuran = Iuran::select('tbl_iuran.*')
                    ->join(DB::raw('(SELECT MAX(id_iuran) as max_id FROM tbl_iuran GROUP BY user_id) as grouped_iurans'), function ($join) {
                        $join->on('tbl_iuran.id_iuran', '=', 'grouped_iurans.max_id');
                    })
                    ->get();
                foreach($lastIuran as $iuran){
                   $newIuran = Iuran::create([
                        'nama_iuran'        => $iuran->nama_iuran,
                        'nominal_iuran'     => $iuran->nominal_iuran,
                        'date_created'      => $today,
                        'user_id'           => $iuran->user_id,
                        'jenazah_id'        => $iuran->jenazah_id,
                    ]);

                if($newIuran){
                     $this->sendWA($iuran->user_id, $iuran->user->no_hp);
                }
            }
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Hari ini bukan tanggal 01.'
        ]);
    }

    private function sendWA($user_id, $no_hp)
    {
        //Ambil data user
        $user = User::where('id', $user_id)->first();

        $message = "Yth. *$user->nama_lengkap* iuran terbaru Anda sudah terbit. Silahkan masuk ke dashboard sistem Anda untuk melakukan pembayaran. Terima kasih.";

        $data = [
            'api_key' => 'V8C5BNUFFI', //isikan API KEY
            'sender' => '62881024008384', // isikan NO PENGIRIM
            'number' => $no_hp, // isikan NO TUJUAN
            'message' => $message
        ];
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://wagateway.ifibernet.id/gateway/api/message', //isikan URL GATEWAY
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => http_build_query($data),
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // dd($response);
    }

}
