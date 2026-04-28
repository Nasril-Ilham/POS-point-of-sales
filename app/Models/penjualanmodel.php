<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class penjualanmodel extends Model
{
    protected $table = 't_penjualan';
    protected $primaryKey = 'id_penjualan';
    protected $fillable = ['tanggal_penjualan', 'total_penjualan', 'id_user'];
}
