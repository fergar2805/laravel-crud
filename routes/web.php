<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
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

/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', [UserController::class, 'index'])->name('index');

Route::post('/user/create', [UserController::class, 'create']);


Route::get('/post', [PostController::class, 'index'])->name('post')->middleware('auth');
Route::get('/post/create', [PostController::class, 'create'])->name('postCreate')->middleware('auth');
Route::post('/post/store', [PostController::class, 'store'])->name('postStore')->middleware('auth');
Route::get('/post/{post}', [PostController::class, 'show'])->name('postShow')->middleware('auth');
Route::get('/post/{post}/edit/', [PostController::class, 'edit'])->name('postEdit')->middleware('auth');
Route::put('/post/{post}', [PostController::class, 'update'])->name('postUpdate')->middleware('auth');
Route::delete('/post/destroy/{post}', [PostController::class, 'destroy'])->name('postDelete')->middleware('auth');

Route::get('/comment/getComments/{postId}', [CommentController::class, 'getComments']);
Route::post('/comment/addComment', [CommentController::class, 'addComment']);
Route::post('/comment/updateComment', [CommentController::class, 'updateComment']);
Route::get('/comment/deleteComment/{id}', [CommentController::class, 'deleteComment']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/migrate', function() {
    Artisan::call('migrate');
    
    return 'Migration executed succesfully';
});
