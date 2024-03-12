<?php

use App\Http\Controllers\AccountsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\SupervisorsController;
use App\Http\Controllers\VehiclesController;
use App\Models\Supervisors;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SupvController;
use App\Livewire\Ofcr;
use App\Livewire\Supv;
use App\Livewire\Vhcl;
use App\Http\Controllers\Combine;
use App\Http\Controllers\GeolocationController;



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


Route::redirect('/', destination: 'landing-page');

Route::get('/landing-page', function(){
    return view('pages.landing-page');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::get('supv/{id}',[Supv::class, 'status']);
Route::get('ofcr/{id}',[Ofcr::class, 'status']);

Route::controller(SupervisorsController::class)->group(function(){
    Route::get('/supervisors','index')->middleware(['auth', 'verified'])->name('supervisors');
    Route::patch('/supervisors/update/{id}','update')->name('supervisors.update');
    Route::post('/supervisors/create','create_supervisor')->name('supervisors.create_supervisor');
    Route::delete('/delete/{supervisor}','supervisor_delete')->name('supervisor_delete');
    Route::get('/sms','App\Http\Controllers\SmsController@sms')->name('sms.sms');
    Route::get('/messenger', 'messenger')->name('messenger.messenger');

});

Route::controller(AccountsController::class)->group(function(){
    Route::get('/accounts','index')->middleware(['auth', 'verified'])->name('accounts');
    Route::patch('/accounts/update/{id}','update')->name('accounts.update');
    Route::post('/accounts/create','create_account')->name('accounts.create_account');
    Route::delete('/delete1/{account}','destroy')->name('accounts.delete');
    Route::get('mobile', 'mobile')->name('mobile.mobile');
});


Route::controller(VehiclesController::class)->group(function(){
    Route::get('/vehicles','index')->middleware(['auth', 'verified'])->name('vehicles');
    Route::patch('/vehicles/update/{id}','update')->name('vehicles.update');
    Route::delete('/vehicles/delete/{vehicle}','destroy')->name('vehicles.destroy');
    Route::post('/vehicles/create','create_vehicle')->name('vehicles.create_vehicle');
    Route::get('/download/{number}','downloadQR')->name('vehicles.downloadQR');
    Route::get('/scanner', 'scan')->name('scanner');
    Route::get('/scanner/data/{id}', 'data');
    Route::get('/vehicle/{vehicleId}', 'status');
    Route::patch('/vehicle/status/{plate}','updateStatus');
    Route::post('/vehicles/borrow','borrow')->name('vehicles.borrow');

});

Route::get('/status', [StatusController::class, 'index'])->name('vehicle.status');
Route::get('/dashboard', [DashboardController::class, 'countUsersByRole'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/tracking', [LocationController::class, 'index'])->name('tracking');
Route::patch('/profile_address', [ProfileController::class, 'addressUpdate'])->name('profile.addressUpdate');

require __DIR__.'/auth.php';

// web.php

Route::post('/geolocations/update', [GeolocationController::class, 'saveGeolocation']);
Route::get('/tracking', [Combine::class, 'index'])->name('tracking');
// Add this to your routes file (web.php or routes.php)
// Add this to your routes file (web.php or routes.php)
Route::get('/geolocations/getAndBorrow', 'GeolocationController@getAndBorrow');

// Add other routes as needed

