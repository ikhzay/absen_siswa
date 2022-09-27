<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    public function index(){
       $siswa = Siswa::get();
        return response()->json([
            'status' => 'success',
            'message' => 'List of Siswa',
            'data' => $siswa
        ], 200);
    }

    public function get($id){
        $data = Siswa::where('nis',$id)->first();
        if($data){
	        return response()->json([
	            'status' => 'success',
	            'message' => 'Detail Siswa Found',
	            'data' => $data
	        ], 200);
	    }else{
	    	return response()->json([
	            'status' => 'error',
	            'message' => 'Detail Siswa Not Found',
	            'data' => null
	        ], 404);
	    }
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            "nis" => "required",
            "nama_siswa" => "required",
            "kelas" => "required",
            "jurusan" => "required",
            "card" => "required",
            // "foto" => "required",
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'Error',
                'message' => $validator->messages()->all()
            ],500);
        }
      
        $data = new Siswa;
        $data->nis = $request->nis;
        $data->nama_siswa = $request->nama_siswa;
        $data->kelas = $request->kelas;
        $data->jurusan = $request->jurusan;
        $data->card = $request->card;
        $data->foto = null;
        $data->save();
        
        return response()->json([
            'status' => 'success',
            'message' => 'New Siswa Created',
            'data' => $data
        ], 201);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            "nis" => "required",
            "nama_siswa" => "required",
            "kelas" => "required",
            "jurusan" => "required",
            "card" => "required",
            // "foto" => "required",
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'Error',
                'message' => $validator->messages()->all(),
            ],500);
        }
        
        $data = Siswa::firstWhere('id',$id);
        if ($data){
            $data->nis = $request->nis;
            $data->nama_siswa = $request->nama_siswa;
            $data->kelas = $request->kelas;
            $data->jurusan = $request->jurusan;
            $data->card = $request->card;
            $data->update();
            return response()->json([
	            'status' => 'success',
	            'message' => 'Siswa Updated',
	            'data' => $data
	        ], 201);
        }else{
            return response()->json([
	            'status' => 'error',
	            'message' => 'Siswa Not Found',
	            'data' => null
	        ], 404);
        }
    }

    public function destroy($id){
        $data = Siswa::findOrFail($id);
        $data->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Detail Siswa Deleted',
            'data' => null
        ], 201);
    }

    public function send(Request $request){
        return $request->card;
    }
}
