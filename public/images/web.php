<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('landing', function () {
    return view('landing');
});

Route::get('login', function () {
    return view('login');
});

Route::get('mobile', function () {
    return view('mobile');
});

Route::get('home', function () {
    return view('home');
});

Route::get('/call', [YourController::class, 'callFunction'])->name('call');
Route::get('/scan', [YourController::class, 'scanFunction'])->name('scan');
Route::get('/message', [YourController::class, 'messageFunction'])->name('message');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
