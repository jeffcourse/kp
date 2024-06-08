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
        'kode_gudang',
        'qty_masuk',
        'qty_keluar'
    ];

}
