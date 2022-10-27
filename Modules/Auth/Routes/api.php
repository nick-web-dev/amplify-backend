<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\AuthController;
use Modules\Auth\Http\Controllers\LoginController;
use Modules\Auth\Http\Controllers\RolesController;

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

Route::delete('/logout', [AuthController::class, 'logout']);


Route::middleware(['auth:api'])->get('/user', function (Request $request) {
    $user  = $request->user();
    $user->setAppends(['all_permissions']);
    return $user;
});
Route::post('/login', [LoginController::class, 'login']);

Route::apiResource('roles', RolesController::class);
