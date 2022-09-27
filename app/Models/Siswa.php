<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'data_siswa';
    protected $fillable = ['nis','nama_siswa','card'];

    public function absen(){
        return $this->hasMany(Absen::class, 'card_id', 'card');
    }
}
