<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class levelmodel extends Model
{

// Level has many users
protected $table = 'm_level';
protected $primaryKey = 'level_id';
protected $fillable = ['level_kode', 'level_nama'];
   public function users(): HasMany
   {
    return $this->hasMany(usermodel::class, 'level_id', 'level_id');
   }
}
