<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class suppliermodel extends Model
{
    protected $table = 'm_supplier';
    protected $primaryKey = 'supplier_id';
    protected $fillable = ['supplier_kode', 'supplier_nama', 'supplier_alamat'];

    public function stok()
    {
        return $this->hasMany(stockmodel::class, 'supplier_id', 'supplier_id');
    }
}
