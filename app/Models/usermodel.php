<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Penting untuk Auth
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class usermodel extends Authenticatable
{
    use HasFactory;

    protected $table = 'm_user';
    protected $primaryKey = 'user_id';
    public $timestamps = true;

    protected $fillable = ['level_id', 'user_nama', 'nama', 'password'];

    /**
     * Beritahu Laravel bahwa field untuk username adalah 'user_nama'
     */
    public function getAuthIdentifierName()
    {
        return 'user_nama';
    }

    /**
     * Relasi: User dimiliki oleh Level (Many to One)
     * Menghubungkan level_id di tabel m_user ke level_id di tabel m_level
     */
    public function level(): BelongsTo
    {
        return $this->belongsTo(levelmodel::class, 'level_id', 'level_id');
    }

    // authorizer 

    // mendapatkan nama role
    public function getRoleName(): string
    {
        return $this->level->level_nama; 
    }

    // cek apkah user punya role sesuatu / penting

    public function hasRole($role): bool
    {
        return $this->level->level_nama == $role ;
    }



    // authorizer end

    /**
     * Relasi: User bisa memiliki banyak Stok (One to Many)
     * Menghubungkan user_id di tabel m_stok ke user_id di tabel m_user
     */
    public function stok(): HasMany
    {
        return $this->hasMany(stockmodel::class, 'user_id', 'user_id');
    }
}