<?php

use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\userController;
use App\Http\Controllers\AdminController;

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
Route::get('/user/dashboard',[userController::class,'index'])->name('user.dashboard');
Route::get('/pengaduan',[userController::class,'formPengajuan'])->name('user.pengajuan');
Route::post('/pengaduan',[userController::class,'store'])->name('user.store');
Route::get('/pengaduan/{id}/detail',[userController::class,"showDetail"])->name('user.detail');
Route::delete('/dashboard/{id}/delete', [UserController::class, 'destroy'])->name('user.destroy');

// Admin
Route::get('/admin/dashboard',[AdminController::class,'index'])->name('admin.dashboard');
Route::get('/fetch-judul/{id}', [AdminController::class, 'fetchJudul'])->name('fetch-judul');
Route::post('/approve-action', [AdminController::class, 'approveAction'])->name('approveAction');
// Route::get('/get-approval-status/{id_pengaduan}', [AdminController::class, 'getApprovalStatus']);





// pdf
Route::get('/generate-pdf', [PDFController::class, 'generatePDF']);
