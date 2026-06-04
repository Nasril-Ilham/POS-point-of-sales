<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class penjualanmodel extends Model
{
    protected $table = 't_penjualan';
    protected $primaryKey = 'penjualan_id';
    protected $fillable = ['penjualan_tanggal', 'total_penjualan', 'user_id', 'pembeli', 'penjualan_kode'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function barang()
    {
        return $this->belongsToMany(barangmodel::class, 't_penjualan_detail', 'id_penjualan', 'id_barang')
            ->withPivot('jumlah', 'harga_jual');
    }

    
}
