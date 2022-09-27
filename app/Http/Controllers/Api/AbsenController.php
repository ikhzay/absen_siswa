<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\returnSelf;

class AbsenController extends Controller
{
    public function index(){
        $data = Absen::get();
         return response()->json([
             'status' => 'success',
             'message' => 'List of Absen',
             'data' => $data
         ], 200);
     }
 
    public function get($id){
        $data = Absen::where('nis',$id)->first();
        if($data){
            return response()->json([
                'status' => 'success',
                'message' => 'Detail Absen Found',
                'data' => $data
            ], 200);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Detail Absen Not Found',
                'data' => null
            ], 404);
        }
    }

    public function getByParam($tgl,$status,$kelas,$jurusan){

        if ($status==0){
            $data = DB::select("
                SELECT * FROM `data_siswa` WHERE nama_siswa NOT IN
                (SELECT nama_siswa FROM data_absen,data_siswa 
                WHERE `tgl`='".$tgl."'
                AND card=card_id
                AND `status`<>".$status." 
                AND `kelas`='".$kelas."'
                AND `jurusan`='".$jurusan."')
                AND `kelas`='".$kelas."'
                AND `jurusan`='".$jurusan."'
            ");
        }else{
            $data = DB::table('data_absen')
            ->join('data_siswa', 'data_absen.card_id', '=', 'data_siswa.card')
            ->where('tgl',$tgl)
            ->where('status',$status)
            ->where('kelas',$kelas)
            ->where('jurusan',$jurusan)
            ->get();
        }

        if($data){
            return response()->json([
                'status' => 'success',
                'message' => 'Detail Absen Found',
                'data' => $data
            ], 200);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Detail Absen Not Found',
                'data' => null
            ], 404);
        }
    }
 
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            "card_id" => "required",
            "mesin" => "required",
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'Error',
                'message' => $validator->messages()->all()
            ],500);
        }

        $siswa = Siswa::where('card',$request->card_id)->first();
        if(!$siswa){
            return response()->json([
                'status' => 'error',
                'message' => 'Card Not Found',
                'data' => null
            ], 404);
        }
        $today = Carbon::now()->format('Y-m-d');
        $absen = Absen::where(['card_id'=>$request->card_id, 'tgl'=> $today])->first();

        if($absen){
            return response()->json([
                'status' => 'error',
                'message' => 'Data Entered',
                'data' => $absen
            ], 501);
        }
        // return $siswa;
    
        $data = new Absen;
        $data->card_id = $request->card_id;
        $data->tgl = Carbon::now()->format('Y-m-d');
        $data->mesin = $request->mesin;
        $data->jam_absen = Carbon::now()->format('H:i:m');

        // Status : 
        // 0 = Tidak Masuk
        // 1 = Masuk tepat Waktu
        // 2 = Masuk telat
        if ($data->jam_absen < '07:30:00'){
            $data->status = 1;
        }
        else {
            $data->status = 2;
        }
    
        $data->save();
        return response()->json([
            'status' => 'success',
            'message' => 'New Absen Created',
            'data' => $data
        ], 201);
    }
}
