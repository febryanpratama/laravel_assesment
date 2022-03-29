<?php

use App\Http\Controllers\APIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('user', [APIController::class,'getUsers']);
Route::post('user/detail', [APIController::class,'detailUsers']);
Route::post('user/create', [APIController::class,'addUsers']);
Route::post('user/update', [APIController::class,'editUsers']);
Route::post('role/update', [APIController::class, 'updateRole']);
