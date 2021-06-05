<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('messages', [ApiController::class, 'getMessages'])->name('api.messages.show');
Route::middleware('auth:sanctum')->patch('messages/{id}', [ApiController::class, 'readMessage'])->name('api.messages.read');


Route::get('register', [ApiController::class, 'register'])->name('api.device.register');
