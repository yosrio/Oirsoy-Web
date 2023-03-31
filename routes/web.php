<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::get('dashboard', [AuthController::class, 'dashboard']); 
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'customLogin'])->name('login.custom');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'customRegister'])->name('register.custom'); 
Route::get('signout', [AuthController::class, 'signOut'])->name('signout');

// Route::get('/', function () {
//     return view('index');
// });

// Route::get('/dashboard', function () {
//     return view('backoffice/dashboard/index');
// });
