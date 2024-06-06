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
    protected $primaryKey = 'id';

    protected $keyType = 'integer';

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

    public function satuan(){
        return $this->belongsTo(Satuan::class,'id_satuan');
    }
    public function jualDetail(){
        return $this->hasMany(JualDetail::class,'id_brg');
    }
}
