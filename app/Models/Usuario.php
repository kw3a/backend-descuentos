<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    protected $table = 'usuario';
    protected $primarykey = 'id_Usuario';
    protected $fillable = ['nombre','email','password','telefono'];
    protected $hidden   = ['password','remember_token'];
    protected $casts = ['email_verified_at' => 'datetime'];

    public function negocio()
    {
        return $this->hasMany(Negocio::class, 'id_Negocio', 'id_Negocio');
    }
}
