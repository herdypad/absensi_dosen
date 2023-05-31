<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Presensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApiPresensiController extends Controller
{
    public function absenMasuk(Request $request)
    {
        $status = "Hadir";
        $ts_now = Carbon::now()->timestamp;
        $ts_masuk = Carbon::createFromFormat('H:i:s', '22:00:00')->timestamp;
        if ($ts_masuk < $ts_now) {
            $status = "Telat";
        }
        if ($request->izin) {
            $status = "Izin";
        }
        $data = [
            'user_id' => $request->id,
            'status' => $status,
            'tgl_presensi' => date('Y-m-d'),
            'jam_masuk' => date('h:i:s'),
            'ket' => $request->ket,
        ];
        Presensi::create($data);

        return response()->json([
            'status' => 'success',
            'message' =>'Berhasil Melakukan Absensi',
        ], 200);
    }

    public function absenKeluar(Request $request)
    {
        Presensi::where('id',  $request->id)->update([
            'jam_pulang' => date('h:i:s')
        ]);

        return response()->json([
            'status' => 'success',
            'message' =>'Berhasil Melakukan Absensi',
        ], 200);
    }

    public function dataAbsen(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahunAbsensi' => 'required',
            'bulanAbsensi' => 'required',
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 401);
        }

        $id = $request->id;
        $tahunAbsensi = $request->get('tahunAbsensi');
        $bulanAbsensi = $request->get('bulanAbsensi');

        $data = DB::table('presensis')
            ->select('*')
            ->whereMonth('tgl_presensi', $bulanAbsensi)
            ->whereYear('tgl_presensi', $tahunAbsensi)
            ->where('user_id', '=', $id)
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ], 200);
    }
}
