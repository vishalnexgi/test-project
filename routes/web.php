<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

Auth::routes();

Route::get('/', function() {
    return redirect()->route('login');
});

Route::resource('/post', PostController::class)->middleware('auth');
Route::get('/post-status/{id}', [App\Http\Controllers\PostController::class, 'post_status'])->name('post.status');
Route::get('/post-delete/{id}', [App\Http\Controllers\PostController::class, 'post_delete'])->name('post.delete');
