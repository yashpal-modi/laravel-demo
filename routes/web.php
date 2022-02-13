<?php

use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\Auth\UserController;

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

Route::middleware('auth')->group(function(){

    Route::get('dashboard', [UserController::class, 'dashboard']); 

    Route::resource('post', PostController::class);
});

Route::get('/',[UserController::class, 'index'])->name('login');

Route::get('login', [UserController::class, 'index'])->name('login');

Route::post('post-login', [UserController::class, 'postLogin'])->name('login.post'); 

Route::put('update/{user}', [UserController::class, 'updateUser'])->name('login.update');

Route::get('registration', [UserController::class, 'registration'])->name('register');

Route::post('post-registration', [UserController::class, 'postRegistration'])->name('register.post'); 

Route::get('logout', [UserController::class, 'logout'])->name('logout');

