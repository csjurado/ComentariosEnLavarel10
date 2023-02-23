<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable =['body']; // capa de seguridad que implementamos 

    public function user() // un comentario pertenece a un usuario 
    {
        return $this->belongsTo(User::class);// pertenece a un usuario 
    }
    public function replies() // un comentario puede tener muchas respuestas 
    {
        return $this->hasMany(Reply::class); // tiene muchas respuestas
    }
}
