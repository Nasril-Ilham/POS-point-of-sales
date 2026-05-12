<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class supliermodel extends Model
{
    protected $table = 'm_supplier';
    protected $primaryKey = 'supplier_id';
    protected $fillable = ['supplier_nama', 'supplier_alamat','supplier_kode'];


    public function stok()
    {
        return $this->hasMany(stockmodel::class, 'supplier_id', 'supplier_id');
    }
}
