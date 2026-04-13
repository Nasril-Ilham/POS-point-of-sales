<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usermodel extends Model
{
    use HasFactory;

    protected $table ='m_user';
    protected $primaryKey = 'user_id';

    //
    
    // $fillabe untuk data yang bisa di rubah seperti di tambahkan atau di update 

    protected $fillable = ['level_id','user_nama', 'nama'];

}
