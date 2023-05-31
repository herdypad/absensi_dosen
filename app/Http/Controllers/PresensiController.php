<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Presensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PresensiController extends Controller
{

    //PRESENSI
    public function presensi()
    {
        $title = 'Presensi';
        $today = Carbon::now()->toDateString();
        $presensi = Presensi::where('user_id', Auth::user()->id)->where('tgl_presensi', $today)->first();
        $status = $presensi->status ?? "status";
        return view('pegawai.presensi', compact('title', 'presensi', 'status'));
    }

    public function masuk(Request $request)
    {
        $img = $request->image;
        $folderPath = "presensi/masuk-";

        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';

        $file = $folderPath . $fileName;
        Storage::put($file, $image_base64);
        $status = "Hadir";
        $ts_now = Carbon::now()->timestamp;
        $ts_masuk = Carbon::createFromFormat('H:i:s', '22:00:00')->timestamp;
        if ($ts_masuk < $ts_now) {
            $status = "Telat";
        }
        if ($request->izin) {
            $status = "Izin";
        }
        $lokasi = $request->lokasi;
        
        $data = [
            'user_id' => Auth::user()->id,
            'status' => $status,
            'tgl_presensi' => date('Y-m-d'),
            'jam_masuk' => date('h:i:s'),
            'foto_masuk' => $fileName,
            'lokasi_masuk' => $lokasi,
            'ket' => $request->ket,
        ];
        Presensi::create($data);
        return redirect(route('pegawai.presensi'));
    }
    public function pulang(Request $request, Presensi $presensi)
    {
        $img = $request->image;
        $folderPath = "presensi/pulang-";
        $lokasi = $request->lokasi;


        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';

        $file = $folderPath . $fileName;
        Storage::put($file, $image_base64);


        Presensi::where('id', $presensi->id)->update([
            'jam_pulang' => date('h:i:s'),
            'foto_pulang' => $fileName,
            'lokasi_pulang' => $lokasi,
        ]);
        return redirect(route('pegawai.presensi'));
    }
}
