<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class usermodel extends Model
{
    use HasFactory;

    protected $table ='m_user';
    protected $primaryKey = 'user_id';
    public $timestamps = true;

    //
    
    // $fillabe untuk data yang bisa di rubah seperti di tambahkan atau di update 

    protected $fillable = ['level_id','user_nama', 'nama', 'password'];

    // User belongs to Level
    //

    public function level(): BelongsTo
    {
        return $this->belongsTo(levelmodel::class, 'level_id', 'level_id');
    }

    public function stok()
    {
        return $this->hasMany(stockmodel::class, 'user_id', 'user_id');
    }

}
