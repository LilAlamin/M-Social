<?php

use App\Http\Controllers\userController;
use App\Http\Controllers\Auth;
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
// Login
Route::get('/',[Auth::class,'login']);
Route::post('/',[Auth::class,'masuk']);
Route::get('/logout',[Auth::class,'logout']);
Route::get('/daftar',[Auth::class,'registerForm']);
Route::post('/daftar',[Auth::class,'register'])->name('daftar');
Route::get('/daftar', function () {
    return view('auth/register');
});

// Users
Route::get('/dashboard',[userController::class,'index']);