<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;
    protected $fillable = ['comment_id','body'];
    public function user() // una respuestas pertenece a un usuario 
    {
        return $this->belongsTo(User::class);// pertenece a un usuario 
    }
    public function comment() // una respuesta tambien pertenece a un comentario
    {
        return $this->belongsTo(Comment::class);// pertenece a un usuario 
    }
}
