<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/hello',function(){
//     return "Hello FROM route";
// });



// Route::get('/post',[PostController::class,'index']);

// Route::get('/show/{name}',[PostController::class,'show']);

// // view all route
// Route::get('/view-all',[PostController::class,'viewPosts']);

// Route::get('/store', [PostController::class,'save']);

Route::get('/todo',[TodoController::class,'index'])->name('todo.index');
Route::get('/todo/store',[TodoController::class,'store'])->name('store');
Route::get('/todo/{id}/edit',[TodoController::class,'edit'])->name('todo.edit');
Route::get('todo/{id}/update',[TodoController::class,'update'])->name('update');
 Route::delete('todo/{id}/destroy',[TodoController::class,'destroy'])->name('destroy');

Auth::routes();

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/',[PostController::class, 'index'])->name('index');
});

Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
Route::post('/post/store', [PostController::class, 'store'])->name('post.store');
Route::get('/{id}/show', [PostController::class, 'show'])->name('post.show');
Route::get('/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
Route::patch('/{id}/update', [PostController::class, 'update'])->name('post.update');
Route::delete('/{id}/destroy', [PostController::class, 'destroy'])->name('post.destroy');
Route::post('/{post_id}/store',[CommentController::class, 'store'])->name('comment.store');
Route::delete('/{id}/destroy',[CommentController::class, 'destroy'])->name('comment.destroy');
Route::get('/profile',[UserController::class,'showProfile'])->name('profile.show');
Route::get('/edit',[UserController::class,'edit'])->name('profile.edit');
Route::patch('/update', [UserController::class, 'update'])->name('profile.update');


// Route::group(['prefix' => 'post' ,'as'=> 'post.'], function(){
//     Route::get('/create', [PostController::class, 'create'])->name('create');
//     Route::post('/store',[PostController::class, 'store'])->name('store');
// });