<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenjualanDetailmodel extends Model
{
    protected $table = 't_penjualan_detail';
    protected $primaryKey = 'id_penjualan_detail';
    protected $fillable = ['id_penjualan', 'id_barang', 'jumlah', 'harga_jual'];

    public function barang()
    {
        return $this->belongsTo(barangmodel::class, 'id_barang', 'barang_id');
    }
}
