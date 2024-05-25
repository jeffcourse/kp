<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JualDetail extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "jual_dtl";

    // Specify the primary key column
    protected $primaryKey = 'no_bukti';

    // Disable auto-incrementing on the primary key
    public $incrementing = false;

    // Indicate that the primary key is not an integer
    protected $keyType = 'string';

    public function jual(){
        return $this->belongsTo(Jual::class,'no_bukti');
    }

    public function satuan(){
        return $this->belongsTo(Satuan::class,'id_satuan');
    }
}
