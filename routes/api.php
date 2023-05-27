<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TelegramController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/sendmessage', [TelegramController::class, 'sendMessage']);

Route::get('/senddoc', [TelegramController::class, 'sendDocument']);

Route::get('/sendbtn', [TelegramController::class, 'sendButtons']);

Route::get('/sendbtn2', [TelegramController::class, 'sendButtons2']);

Route::post('/callback', [TelegramController::class, 'handleCallbackQuery']);

Route::get('/getinfo', [TelegramController::class, 'getinfo']);

Route::post('/telegram/webhook', [TelegramController::class, 'handleUpdate']);
