<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpnameStok extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "opname_stok";

    protected $primaryKey = 'id';

    protected $keyType = 'integer';

    /*protected $fillable = [
        'tanggal',
        'kode_brg',
        'nama_brg',
        'id_satuan',
        'kode_gudang',
        'qty_sistem',
        'qty_fisik',
        'selisih',
        'keterangan'
    ];*/

    public function master(){
        return $this->belongsTo(Master::class,'kode_brg');
    }
    public function gudang(){
        return $this->belongsTo(Gudang::class,'kode_gudang');
    }
}
