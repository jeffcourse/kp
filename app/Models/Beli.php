<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beli extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "beli";

    // Specify the primary key column
    protected $primaryKey = 'no_bukti';

    // Disable auto-incrementing on the primary key
    public $incrementing = false;

    // Indicate that the primary key is not an integer
    protected $keyType = 'string';

    public function beliDetail(){
        return $this->hasMany(BeliDetail::class,'no_bukti');
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class,'kode_supp');
    }
}
