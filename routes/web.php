<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventDetailController;
use App\Http\Controllers\LoginController;

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
Route::get('/', [LoginController::class, 'index']);
Route::resource('event', EventController::class);

Route::resource('event-detail', EventDetailController::class);

Route::post('event-detail/changestatus/{eventDetail}', [
    EventDetailController::class, 'changeStatus'
])->name('event-detail.changeStatus');

Route::get('login', [LoginController::class, 'login']);

Route::post('login', [LoginController::class, 'postLogin'])->name('login');