<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function apiLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 401);
        }
        // dd($validator);

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            $fotoProfile = DB::table('pegawais')
            ->select('foto')
            ->where('user_id', '=',  Auth::user()->id)
            ->limit(1)
            ->get();

            // dd($fotoProfile[0]->foto);
            $urlPathFoto = env('APP_URL') . 'api/file/' . $fotoProfile[0]->foto;

            return response()->json([
                'status' => 'success',
                'message' => Auth::user(),
                'foto' => $urlPathFoto,
            ], 200);
        }



    }
}
