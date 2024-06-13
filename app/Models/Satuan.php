<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "satuan";

    // Specify the primary key column
    protected $primaryKey = 'id';

    // Disable auto-incrementing on the primary key
    public $incrementing = false;

    // Indicate that the primary key is not an integer
    protected $keyType = 'integer';
    
    public function master(){
        return $this->hasMany(Master::class,'id_satuan');
    }

    public function beliDetail(){
        return $this->hasMany(BeliDetail::class, 'id_satuan');
    }

    public function jualDetail(){
        return $this->hasMany(JualDetail::class, 'id_satuan');
    }

    public function mutasiStok(){
        return $this->hasMany(MutasiStok::class, 'id_satuan');
    }
}
