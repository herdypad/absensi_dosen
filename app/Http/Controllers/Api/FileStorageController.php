<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PresensiInit;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FileStorageController extends Controller
{

    /**
     * @OA\GET(
     *     path="/api/file/{FILE}",
     *     tags={"FILE STORAGE"},
     *     summary="File",
     *     description="Liat File",
     *     operationId="show_file",
     *     @OA\Parameter(
     *          name="FILE",
     *          in="path",
     *
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
    public function DownloadFile($FILE)
    {
        //file_absensi, file_pengumuman, file_pengajuan
        //UIMG202305316476fccf036b4.jpg
        try{
        $fileServer ='users/images/';
        $content = $fileServer.'/'.$FILE;
        return response()->file($content);

        }catch(Exception $e){
            return response()->json([
                'message' => 'Data Tidak Ditemukan'
            ], 204);
        }

    }


    public function UploadFile(Request $request)
    {
        // dd($request->all());

        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'FOTO' => 'required',
        ]);
        if ($validator->fails()) {
        // return new PresensiInit(false, 'Validasi Failed', $validator->errors()->first());
        }

        $file = Request()->file('FOTO');
        $date = (string)date('ymdhis');
        $fileName = $date . $file->getClientOriginalName();
        // $file->move('../../../../../../file_server/', $fileName);
        $file->move('../../../file_server/', $fileName);
        $photoUrl =  url('api/file/' . $fileName);

        return response()->json(['url' => $photoUrl],200);

    }



}

