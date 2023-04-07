<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backoffice\AuthController;
use App\Http\Controllers\Backoffice\ProfileController;
use App\Http\Controllers\Backoffice\UserController;
use App\Http\Controllers\Backoffice\RolesController;
use App\Http\Controllers\Backoffice\ConfigurationController;

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

Route::get('admin', [AuthController::class, 'index'])->name('login');
Route::get('admin/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('admin/login', [AuthController::class, 'index'])->name('login');
Route::post('admin/login', [AuthController::class, 'customLogin'])->name('login.custom');
Route::get('admin/register', [AuthController::class, 'register'])->name('register');
Route::post('admin/register', [AuthController::class, 'customRegister'])->name('register.custom');
Route::get('admin/logout', [AuthController::class, 'logOut'])->name('logout');

Route::get('admin/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('admin/profile/updateProfile', [ProfileController::class, 'updateProfile'])->name('updateProfile');

Route::get('admin/users', [UserController::class, 'index'])->name('users');
Route::get('admin/users/add', [UserController::class, 'addOrUpdate'])->name('user.add');
Route::post('admin/users', [UserController::class, 'save'])->name('user.save');
Route::get('admin/users/update/{id}', [UserController::class, 'addOrUpdate'])->name('user.update');
Route::get('admin/users/{id}', [UserController::class, 'delete'])->name('user.delete');

Route::get('admin/roles', [RolesController::class, 'index'])->name('roles');
Route::get('admin/roles/add', [RolesController::class, 'addOrUpdate'])->name('roles.add');
Route::post('admin/roles', [RolesController::class, 'save'])->name('roles.save');
Route::get('admin/roles/update/{id}', [RolesController::class, 'addOrUpdate'])->name('roles.update');
Route::get('admin/roles/{id}', [RolesController::class, 'delete'])->name('roles.delete');

Route::get('admin/configuration', [ConfigurationController::class, 'index'])->name('config');