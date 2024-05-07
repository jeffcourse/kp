<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesPerson extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "sales_person";

    // Specify the primary key column
    protected $primaryKey = 'kode_sales';

    // Disable auto-incrementing on the primary key
    public $incrementing = false;

    // Indicate that the primary key is not an integer
    protected $keyType = 'string';
    
    public function customer(){
        return $this->hasMany(Customer::class,'kode_sales');
    }
}
