<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Linquer\Http\Controllers\TasksController;

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

Route::prefix('linquer')->middleware('auth:api')->group(function () {
    Route::get('tasks', [TasksController::class, 'index']);
});
Route::middleware('auth:api')->get('/linquer', function (Request $request) {
    return $request->user();
});
