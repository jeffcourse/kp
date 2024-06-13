<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutasiStok extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "mutasi_stok";

    protected $primaryKey = 'id';

    protected $keyType = 'integer';

    protected $fillable = [
        'no_bukti',
        'kode_brg',
        'tanggal',
        'nama_brg',
        'id_satuan',
        'kode_gudang',
        'stok_awal',
        'qty_masuk',
        'qty_keluar',
        'qty_rusak_exp',
        'stok_akhir'
    ];

    public function gudang(){
        return $this->belongsTo(Gudang::class,'kode_gudang');
    }

    public function satuan(){
        return $this->belongsTo(Satuan::class,'id_satuan');
    }
}
