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

    public function beli(){
        return $this->hasMany(Beli::class,'kirim_gudang');
    }
}
