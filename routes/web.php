<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('post',PostController::class)->middleware('auth');
Route::get('/',[PostController::class,'index']);
Route::get('/posts/manage',[PostController::class,'manage'])->middleware('auth');
Route::get('/register',[UserController::class,'create'])->middleware('guest');
Route::post('/register',[UserController::class,'store'])->middleware('guest');
Route::get('/login',[UserController::class,'login'])->name('login')->middleware('guest');
Route::post('/login',[UserController::class,'authenticate'])->middleware('guest');
Route::post('/logout',[UserController::class,'logout'])->middleware('auth');

