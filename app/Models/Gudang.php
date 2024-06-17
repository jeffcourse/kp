<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "invgudang";

    // Specify the primary key column
    protected $primaryKey = 'kode';

    // Disable auto-incrementing on the primary key
    public $incrementing = false;

    // Indicate that the primary key is not an integer
    protected $keyType = 'string';
    
    public function master(){
        return $this->hasMany(Master::class,'kode_gudang');
    }

    public function beliDetail(){
        return $this->hasMany(BeliDetail::class,'kirim_gudang');
    }

    public function jualDetail(){
        return $this->hasMany(JualDetail::class,'kode_gudang');
    }

    public function mutasiStok(){
        return $this->hasMany(MutasiStok::class,'kode_gudang');
    }

    public function opnameStok(){
        return $this->hasMany(OpnameStok::class,'kode_gudang');
    }
}
