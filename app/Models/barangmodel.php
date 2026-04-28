<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class barangmodel extends Model
{
    protected $table = 'm_barang';
    protected $primaryKey = 'barang_id';
    protected $fillable = ['barang_nama', 'kategori_id', 'barang_kode', 'harga_jual', 'harga_beli', 'stok'];
     public function penjualanDetail()
    {
        return $this->hasMany(PenjualanDetailmodel::class, 'barang_id', 'barang_id');
    }

    public function kategori()
    {
        return $this->belongsTo(categorymodel::class, 'kategori_id', 'kategori_id');
    }
}
