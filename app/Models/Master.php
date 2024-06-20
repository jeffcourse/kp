<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "invmaster";

    protected $primaryKey = 'id';

    protected $keyType = 'integer';

    /*protected $fillable = [
        'kode_brg',
        'nama_brg',
        'kode_divisi',
        'kode_jenis',
        'kode_type',
        'packing',
        'quantity',
        'id_satuan',
        'hrg_jual',
        'kode_gudang',
        'keterangan',
    ];*/

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
    public function opnameStok(){
        return $this->hasMany(OpnameStok::class,'id_brg');
    }
}
