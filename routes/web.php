<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoggerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrackedUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitController;
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


Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/log/page-visited', [LoggerController::class, 'pageVisited'])->middleware('tokenvalid');
Route::post('/log/event', [LoggerController::class, 'event'])->middleware('tokenvalid');

Route::resource('visit', VisitController::class);
Route::resource('TrackedUser', TrackedUserController::class);
Route::resource('event', EventController::class);

Route::post('visit/list', [VisitController::class, 'list'])->name('visit.list');
Route::post('event/list', [EventController::class, 'list'])->name('event.list');

Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard/chart/{type}', [HomeController::class, 'chart'])->middleware(['auth'])->name('dashboard.chart');

Route::middleware('auth')->group(function () {
    Route::resource('user', UserController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
