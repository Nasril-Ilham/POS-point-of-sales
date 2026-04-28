<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class stockmodel extends Model
{
    protected $table = 'm_stock';
    protected $primaryKey = 'id_stock';
    protected $fillable = ['id_barang', 'jumlah', 'tanggal_stock'];
}
