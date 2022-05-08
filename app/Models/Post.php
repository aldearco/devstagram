<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];


    /**
     * Relación de autoria de los Posts
     */
    public function user(){
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }

    /**
     * Relación del Post con sus Comentarios
     */
    public function comentarios(){
        return $this->hasMany(Comentario::class);
    }
}
