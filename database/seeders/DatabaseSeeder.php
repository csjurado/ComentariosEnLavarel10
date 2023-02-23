<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\Models\User::factory(10) // Creame 10 usuarios 
            ->hasComments(3)    // Cada usuario va a tener 3 comentarios 
            ->create();

        $comments = \App\Models\Comment::get(); // trememe todos los comnetarios 

        foreach ($comments as $comment) { // Creamos respuestas a cada comentario 
            \App\Models\Reply::factory(rand(1, 3))->create([ // por Cada comentario se crea 1 a 3 respuestas
                'comment_id' => $comment->id, // cada respuesta pertenece a un comentario
                'user_id' => rand(1, 10) // pertenecera a un usuario de manera aleatoria del 1 al 10 porque cree 10 usuarios 
            ]);
        }
    }
}
