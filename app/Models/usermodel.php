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

}
