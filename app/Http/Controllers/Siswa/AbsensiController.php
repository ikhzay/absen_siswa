<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index(){
        $today = Carbon::now()->format('Y-m-d');
        $data = Absen::with('siswa')->where('tgl',$today)->get();
        return view('app.absensi',compact('data'));
    }
}
