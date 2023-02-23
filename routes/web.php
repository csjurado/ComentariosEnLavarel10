<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReplyController;
use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', 'dashboard');
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/dashboard', function () {
    $comments = \App\Models\Comment::with('user','replies.user') // optimizamos las consultas
    ->orderBy('id', 'DESC')
    ->paginate(); // Ordenamos los comentarios de manera descendete pro el id 

    return view('dashboard', ['comments' => $comments]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('comments', [CommentController::class, 'store']) // todo el que este logueado puede usar estas rutaas
    ->name('comments.store')
    ->middleware('auth');

Route::post('replies/{comment}', [ReplyController::class, 'store']) // todo el que este logueado puede usar estas rutaas
    ->name('replies.store')
    ->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
