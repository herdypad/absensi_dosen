<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Presensi;
use App\Models\PresensiDetail;
use App\Models\Cabang;
use App\Models\Pegawai;


class DataAbsenController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    // ----------------------------------------- S T A R T  - P R E S E N S I --------------------------------------------//

    public function dataPresensi(Request $request){
        $absen          = Presensi::with('user.presensi')->get();
        $presensi       = Presensi::all();
        $cabang         = Cabang::all();
        $pegawai        = Pegawai::all();
        $user           = User::all();

        return view ('admin.rekap.DataAbsensi')->with([
            'title' => 'Data Presensi',
            'absen'          => $absen,
            'cabang'         => $cabang,
            'presensi'       => $presensi,
            'pegawai'        => $pegawai,
            'user'           => $user,
        ]);
    }
    

    public function presensiManual(Request $request){
        $absen = User::where('role', 'Pegawai')->with('presensi')->paginate(5);
        return view('admin.absen.absensiManual')->with([
            'title' => 'Data User',
            'absen' => $absen,
        ]);
    }


    public function createPresensiManual(Request $request){
        $validator = Validator::Make($request->all(), [
            'user_id'       => 'required|numeric|unique:App\Models\Pegawai,user_id',
            'tgl_presensi'  => 'required',
            'jam_masuk'     => 'required|email|unique:users',
            'jam_pulang'    => 'required',
        ]);

        if($request->telat){
            $status = "Telat";
        }elseif(!$request->telat){
            $status = "Hadir";
        }

        Presensi::create([
            'user_id'           => $request->user_id,
            'status'            => $status,
            'tgl_presensi'      => $request->tgl_presensi,
            'jam_masuk'         => $request->jam_masuk,
            'jam_pulang'        => $request->jam_pulang,
            'ket'               => $request->ket,
            'lokasi_masuk'      => 'Sabang Digital Indonesia',
            'lokasi_pulang'     => 'Sabang Digital Indonesia',
        ]);

        session()->flash('pesan',"Penambahan Daftar Hadir berhasil");
        return redirect()->route('presensiManual');
    }
    

    public function editDataPresensi(Request $request, $id){
        Presensi::where('id', $request->id)
        ->update([
            'tgl_presensi'  => $request->tgl_presensi,
            'jam_masuk'  => $request->jam_masuk,
            'jam_pulang'  => $request->jam_pulang,
        ]);

        session()->flash('pesan',"Perubahan Data {$request['nama']} berhasil");
        return redirect()->route('dataPresensi');
        
    }


    public function deleteDataPresensi(Request $request){
        $user = Presensi::where('id',$request->id)->firstOrFail();
        $user->delete();
        return redirect()->route('dataPresensi')->with('pesan',"Data berhasil dihapus" );
    }

    // ----------------------------------------- E N D  - P R E S E N S I --------------------------------------------//



    // ------------------------------------------- S T A R T  - I Z I N ----------------------------------------------//

    public function izinManual(Request $request){
        $absen = User::where('role', 'Pegawai')->with('presensi')->paginate(5);
        return view('admin.absen.izinManual')->with([
            'title' => 'Data User',
            'absen' => $absen,
        ]);
    }

    
    public function dataIzin(Request $request){
        $absen          = Presensi::with('user.presensi')->get();
        $presensi       = Presensi::all();
        $cabang         = Cabang::all();
        $pegawai        = Pegawai::all();
        $user           = User::all();

        return view ('admin.rekap.DataIzin')->with([
            'title'          => 'Data Izin',
            'absen'          => $absen,
            'cabang'         => $cabang,
            'presensi'       => $presensi,
            'pegawai'        => $pegawai,
            'user'           => $user,
        ]);
        
    }


    public function createIzinManual(Request $request){
        $validator = Validator::Make($request->all(), [
            'user_id'       => 'required|numeric|unique:App\Models\Pegawai,user_id',
            'tgl_presensi'  => 'required',
        ]);

        Presensi::create([
            'user_id'           => $request->user_id,
            'status'            => 'Izin',
            'tgl_presensi'      => $request->tgl_presensi,
            'ket'               => $request->ket,
        ]);

        session()->flash('pesan',"Penambahan Daftar Hadir berhasil");
        return redirect()->route('izinManual');
    }


    public function deleteDataIzin(Request $request){
        $user = Presensi::where('id', $request->id)->firstOrFail();
        $user->delete();
        return redirect()->route('dataIzin')->with('pesan',"Data berhasil dihapus" );
    }


    public function editDataIzin(Request $request, $id){
        Presensi::where('id', $request->id)
        ->update([
            'tgl_presensi'  => $request->tgl_presensi,
            'ket'           => $request->ket,
        ]);

        session()->flash('pesan',"Perubahan Data {$request['nama']} berhasil");
        return redirect()->route('dataIzin');
        
    }

    // ----------------------------------------- E N D  - I Z I N --------------------------------------------//


    // ------------------------------------------- S T A R T  - T E L A T ----------------------------------------------//

    public function dataTelat(Request $request){
        $absen          = User::where('role','Pegawai')->get();
        $presensi       = Presensi::all();
        $cabang         = Cabang::all();
        $pegawai        = Pegawai::all();
        

        return view ('admin.rekap.dataTelat')->with([
            'title'          => 'Data Telat',
            'absen'          => $absen,
            'cabang'         => $cabang,
            'presensi'       => $presensi,
            'pegawai'        => $pegawai,
        ]);
        
    }

    // ----------------------------------------- E N D  - T E L A T --------------------------------------------//
}
