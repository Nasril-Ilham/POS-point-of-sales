<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class stockmodel extends Model
{
    protected $table = 't_stok';
    protected $primaryKey = 'stok_id';
    protected $fillable = ['supplier_id', 'kategori_id', 'user_id', 'stok_tanggal', 'stok_jumlah'];
    
    public function supplier()
    {
        return $this->belongsTo(suppliermodel::class, 'supplier_id', 'supplier_id');
    }
    
    public function kategori()
    {
        return $this->belongsTo(categorymodel::class, 'kategori_id', 'kategori_id');
    }
    
    public function user()
    {
        return $this->belongsTo(usermodel::class, 'user_id', 'user_id');
    }

    public function barang() {
    return $this->belongsTo(BarangModel::class, 'barang_id', 'barang_id');
}
}
