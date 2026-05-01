<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class categorymodel extends Model
{
    protected $table = 'm_kategori';
    protected $primaryKey = 'kategori_id';
    protected $fillable = ['kategori_kode', 'kategori_nama'];

    public function barang()
    {
        return $this->hasMany(barangmodel::class, 'kategori_id', 'kategori_id');
    }

    public function stok()
    {
        return $this->hasMany(stockmodel::class, 'kategori_id', 'kategori_id');
    }
}

