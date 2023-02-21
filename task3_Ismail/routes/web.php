<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/home', [AdminController::class, 'index'])->middleware('auth', 'verified')->name('admin');
Route::get('/dashboard', [UserController::class, 'index'])->middleware('auth', 'verified')->name('dashboard');
Route::get('/unapproved', [UserController::class, 'unapproved'])->middleware(['auth', 'verified'])->name('unapproved');

//delete user
Route::delete('/delete', [AdminController::class, 'delete'])->middleware(['auth', 'verified'])->name('user.delete');
//approve user
Route::patch('/approve', [AdminController::class, 'approve'])->middleware(['auth', 'verified'])->name('user.approve');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
