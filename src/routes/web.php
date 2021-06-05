<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\SettingController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/messages');
});

Route::resource('/messages', MessageController::class, [
    'names' => [
        'index' => 'messages',
        'create' => 'messages.create',
        'store' => 'messages.store',
    ]
])->middleware(['auth']);


/* Friends */
Route::prefix('friends')->middleware(['auth'])->group(function () {
    Route::post('accept/{id}', [FriendController::class, 'accept'])->name('friends.accept');
});
Route::resource('friends', FriendController::class)->middleware(['auth']);

/* Device */
Route::prefix('device')->middleware(['auth'])->group(function () {
    Route::get('status', [DeviceController::class, 'status'])->name('device.status');
});
Route::resource('device', DeviceController::class)->middleware(['auth']);

/* Settings */
Route::prefix('settings')->middleware(['auth'])->group(function () {
    Route::get('/', [SettingController::class, 'index'])->name('settings');
    Route::get('profile', [SettingController::class, 'profile'])->name('settings.profile');
    Route::post('profile', [SettingController::class, 'storeProfile'])->name('settings.profile.store');
    Route::get('device', [SettingController::class, 'device'])->name('settings.device');
    Route::post('device', [SettingController::class, 'storeDevice'])->name('settings.device.store');
    Route::post('mute', [SettingController::class, 'mute'])->name('settings.device.mute');
});

require __DIR__.'/auth.php';
