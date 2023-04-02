<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;

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

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'customLogin'])->name('login.custom');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'customRegister'])->name('register.custom');
Route::get('logout', [AuthController::class, 'logOut'])->name('logout');

Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::post('profile/updateProfile', [ProfileController::class, 'updateProfile'])->name('updateProfile');

Route::get('users', [UserController::class, 'index'])->name('users');
Route::get('users/add', [UserController::class, 'addOrUpdate'])->name('user.add');
Route::post('users', [UserController::class, 'save'])->name('user.save');
Route::get('users/update/{id}', [UserController::class, 'addOrUpdate'])->name('user.update');
Route::get('users/{id}', [UserController::class, 'delete'])->name('user.delete');

Route::get('roles', [RolesController::class, 'index'])->name('roles');
Route::get('roles/add', [RolesController::class, 'addOrUpdate'])->name('roles.add');
Route::post('roles', [RolesController::class, 'save'])->name('roles.save');
Route::get('roles/update/{id}', [RolesController::class, 'addOrUpdate'])->name('roles.update');
Route::get('roles/{id}', [RolesController::class, 'delete'])->name('roles.delete');