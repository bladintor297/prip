<?php

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
Auth::routes();


Route::post('custom-login', [App\Http\Controllers\CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::post('custom-registration', [App\Http\Controllers\CustomAuthController::class, 'customRegistration'])->name('register.custom'); 


Route::get('forget-password', [App\Http\Controllers\LupaPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [App\Http\Controllers\LupaPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [App\Http\Controllers\LupaPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [App\Http\Controllers\LupaPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/update', [App\Http\Controllers\HomeController::class, 'update']);
Route::resource('admin', '\App\Http\Controllers\AdminController')->middleware('status:1', 'role:1');
Route::resource('aktiviti', '\App\Http\Controllers\AktivitiController');
Route::resource('prip', '\App\Http\Controllers\PRIPController')->middleware('status:1');
Route::resource('user', '\App\Http\Controllers\UserController');
Route::resource('modul', '\App\Http\Controllers\ModulController')->middleware('status:1');
Route::get('/filter', [App\Http\Controllers\PRIPController::class, 'filter'])->name('prip.filter'); 
Route::get('/filterAkt', [App\Http\Controllers\AktivitiController::class, 'filter'])->name('prip.filter'); 
Route::get('/autocomplete-search', [App\Http\Controllers\PRIPController::class, 'cariEmel']);
Route::get('/sort/{sort}', [App\Http\Controllers\PRIPController::class, 'create']);
Route::get('/admin/{id}/reject', [App\Http\Controllers\AdminController::class, 'destroy'])->middleware('status:1');
Route::get('aktiviti-prip/{id}', [App\Http\Controllers\AktivitiController::class, 'aktivitiPrip'])->middleware('status:1');
Route::get('mohon-aktiviti/{id}', [App\Http\Controllers\AktivitiController::class, 'mohonAktiviti'])->middleware('status:1');
Route::get('aktiviti/create/{id}', [App\Http\Controllers\AktivitiController::class, 'borangAktiviti'])->middleware('status:1');
Route::get('terima/{id}', [App\Http\Controllers\AktivitiController::class, 'terimaMohon'])->middleware('status:1');;
Route::get('tolak/{id}', [App\Http\Controllers\AktivitiController::class, 'tolakMohon'])->middleware('status:1');
Route::get('/change-password', [App\Http\Controllers\UserController::class, 'changePassword'])->name('change-password');
Route::post('/change-password', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('update-password');
Route::post('/cprip/{id}', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('update-password');
// Route::get('/aktiviti/{id}/edit', [App\Http\Controllers\AktivitiController::class, 'edit']);

