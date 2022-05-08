<?php

namespace App\Models;

use App\Models\Like;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    /**
     * Relación de un Post con los Likes que ha recibido
     */
    public function likes(){
        return $this->hasMany(Like::class);
    }

    /**
     * Revisar si un usuario ya hizo Like
     */
    public function checkLike(User $user){
        return $this->likes->contains('user_id', $user->id);
    }
}
