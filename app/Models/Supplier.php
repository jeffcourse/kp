<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "supplier";

    // Specify the primary key column
    protected $primaryKey = 'kode_supp';

    // Disable auto-incrementing on the primary key
    public $incrementing = false;

    // Indicate that the primary key is not an integer
    protected $keyType = 'string';

    public function beli(){
        return $this->hasMany(Beli::class,'kode_supp');
    }
}
