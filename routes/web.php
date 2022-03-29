<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    // return view('welcome');
    return redirect('/login');
});

Auth::routes(); 
Route::get('/logout', [LoginController::class, 'logout']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'admin', 'middleware'=>['auth', 'isAdmin']], function(){
    // Route::prefix('')
    Route::get('/', [AdminController::class, 'index']);

    Route::prefix('role')->group(function(){
        Route::get('/', [RoleController::class, 'index']);
    });

    Route::get('/user', [AdminController::class, 'indexUser']);
});

Route::group(['prefix'=>'user', 'middleware'=>['auth', 'isUser']], function(){
    // Route::prefix('')
    Route::get('/', [UserController::class, 'index']);
});