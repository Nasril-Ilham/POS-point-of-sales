<?php

namespace App\Models;

use App\Http\Controllers\levelcontroller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class usermodel extends Model
{
    use HasFactory;

    protected $table ='m_user';
    protected $primaryKey = 'user_id';

    //
    
    // $fillabe untuk data yang bisa di rubah seperti di tambahkan atau di update 

    protected $fillable = ['level_id','user_nama', 'nama', 'password'];

    //one to one relationship
    //

    public function level(): HasOne
    {
        return $this->hasone(levelmodel::class, 'level_id', 'level_id');
    }

}
