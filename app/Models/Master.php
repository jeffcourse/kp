<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "invmaster";

    // Specify the primary key column
    protected $primaryKey = 'kode_brg';

    // Disable auto-incrementing on the primary key
    public $incrementing = false;

    // Indicate that the primary key is not an integer
    protected $keyType = 'string';

    public function divisi(){
        return $this->belongsTo(Divisi::class,'kode_divisi');
    }

    public function gudang(){
        return $this->belongsTo(Gudang::class,'kode_gudang');
    }

    public function jenis(){
        return $this->belongsTo(Jenis::class,'kode_jenis');
    }

    public function type(){
        return $this->belongsTo(Type::class,'kode_type');
    }
}
