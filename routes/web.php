<?php

use App\Http\Controllers\PostController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']],function(){

    Route::get('post/create', [PostController::class, 'create'])->name('post-create');
    Route::post('post/store', [PostController::class, 'store'])->name('post.store');
    Route::get('post/view/{id}', [PostController::class, 'view']);
    Route::post('post/update', [PostController::class, 'update'])->name('post.update');
    Route::get('post/delete/{id}', [PostController::class, 'destroy']);

});
