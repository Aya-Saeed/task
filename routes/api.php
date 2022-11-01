<?php

use App\Http\Controllers\ApiController;
use Facade\FlareClient\Api;
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
Route::get('/admin', function () {
    return 'hello';
});
Route::post('/register', [ApiController::class, 'register']);
Route::post('login', [ApiController::class, 'login']);
Route::get('/user/{id}', [ApiController::class, 'show'])->middleware('auth:sanctum');
