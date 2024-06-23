<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "inventory";

    public $incrementing = false;

    protected $primaryKey = 'kode_brg';

    protected $keyType = 'string';

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
        return $this->hasMany(JualDetail::class,'kode_brg');
    }
    public function opnameStok(){
        return $this->hasMany(OpnameStok::class,'kode_brg');
    }
    public function mutasiStok(){
        return $this->hasMany(MutasiStok::class,'kode_brg');
    }
    public function beliDetail(){
        return $this->hasMany(BeliDetail::class,'kode_brg');
    }
}
