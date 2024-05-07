<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "customer";

    // Specify the primary key column
    protected $primaryKey = 'kode_cust';

    // Disable auto-incrementing on the primary key
    public $incrementing = false;

    // Indicate that the primary key is not an integer
    protected $keyType = 'string';

    public function salesPerson(){
        return $this->belongsTo(SalesPerson::class,'kode_sales');
    }
}
