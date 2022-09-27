<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    public function index(){
        $data = Siswa::orderBy("created_at", "DESC")->get();
        // return $data;
        return view('app.siswa.siswa',compact('data'));
    }

    public function get($id){
        $data = Siswa::where('id',$id)->first();
        return view('app.siswa.detailSiswa',compact('data'));
    }


    public function cropImage(Request $request){
        $data = Siswa::where('id',$request->id)->first();
        // return $data;
        $folderPath = public_path('assets/img/siswa/');

        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file= $folderPath.date('YmdHis').'.png';
        
        file_put_contents($file, $image_base64);
        $data->foto = date('YmdHis').'.png';
        $data->update();
        return response()->json(['success'=>'success']);
    }


    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            "nis" => "required",
            "nama_siswa" => "required",
            "card" => "required",
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'Error',
                'message' => $validator->messages()->all()
            ],500);
        }
        

        $data = Siswa::firstWhere('id',$id);
        $data->nis = $request->nis;
        $data->nama_siswa = $request->nama_siswa;
        $data->kelas = $request->kelas;
        $data->jurusan = $request->jurusan;
        $data->card = $request->card;
        $data->update();
        return response()->json(['success'=>'success']);
        // return $this->index();
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            "nis" => "required",
            "nama_siswa" => "required",
            "card" => "required",
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'Error',
                'message' => $validator->messages()->all()
            ],500);
        }
        
        $data = new Siswa;

        if($request->file('foto')){
            $file= $request->file('foto');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('assets/img/siswa'), $filename);
            $data->foto= $filename;
        }

        $data->nis = $request->nis;
        $data->nama_siswa = $request->nama_siswa;
        $data->kelas = $request->kelas;
        $data->jurusan = $request->jurusan;
        $data->card = $request->card;
        // $data->foto = "tes";
        $data->save();
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
}
