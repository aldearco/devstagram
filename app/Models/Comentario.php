<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'comentario'
    ];


    /**
     * Relación de Comentario con el usuario que lo escribió
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
