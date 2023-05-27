<?php

use App\Http\Controllers\TelegramController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/sendmessage', [TelegramController::class, 'sendMessage']);

Route::get('/senddoc', [TelegramController::class, 'sendDocument']);

Route::get('/sendbtn', [TelegramController::class, 'sendButtons']);

Route::get('/sendbtn2', [TelegramController::class, 'sendButtons2']);

Route::get('/setwebhook', [TelegramController::class, 'setwebhook']);

Route::get('/getwebhook', [TelegramController::class, 'getwebhook']);

Route::post('/callback', [TelegramController::class, 'handleCallbackQuery']);

Route::get('/getinfo', [TelegramController::class, 'getinfo']);

Route::post('/webhook', [TelegramController::class, 'handleCallbackQuery']);