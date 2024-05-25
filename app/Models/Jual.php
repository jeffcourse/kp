<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jual extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "jual";

    // Specify the primary key column
    protected $primaryKey = 'no_bukti';

    // Disable auto-incrementing on the primary key
    public $incrementing = false;

    // Indicate that the primary key is not an integer
    protected $keyType = 'string';

    public function jualDetail(){
        return $this->hasMany(JualDetail::class,'no_bukti');
    }

    public function customer(){
        return $this->belongsTo(Customer::class,'kode_cust');
    }
}
