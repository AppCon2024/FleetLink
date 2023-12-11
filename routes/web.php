<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Twilio\Rest\Client as TwilioClient;
use App\Http\Controllers\DialpadController;

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

Route::get('/map', function () {
    return view('map');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dialpad', [DialpadController::class, 'index']);
Route::post('/dial', [DialpadController::class, 'handleDial'])->name('dial');
Route::get('/twilio/voice', [DialpadController::class, 'twilioVoice'])->name('twilio.voice');