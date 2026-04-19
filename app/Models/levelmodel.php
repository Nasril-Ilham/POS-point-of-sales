<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class levelmodel extends Model
{

// public function ini mengarah pada ke usermodel karna tabel user terhubung dengan usermodel
protected $table = 'm_level';
protected $primaryKey = 'level_id';
   public function user(): BelongsTo
   {
    return $this->belongTo(usermodel::class);
   }
}
