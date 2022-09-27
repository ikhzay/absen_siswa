<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;

    protected $table = 'data_absen';

    public function siswa(){
        return $this->belongsTo(Siswa::class, 'card_id', 'card');
    }
}
