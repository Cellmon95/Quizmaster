<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
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
    return view('index');
});

Route::get('register', function () {
    return view('register');
});

Route::get('login', function () {
    return view('login');
})->name('login');

Route::controller(RegisterController::class)->group(function() {
    Route::post('/register/commit', 'register');
});

Route::controller(LoginController::class)->group(function() {
    Route::post('/login/commit', 'login');
    Route::get('/logout', 'logout');
});

Route::controller(DataController::class)->group(function() {
    Route::get('/upload', 'uploadCSV');
});

Route::get('/menu', function(){
    return view('mainMenu');
})->middleware('auth');

Route::controller(GameController::class)->group(function() {
    Route::get('/game', 'startGame')->middleware('auth');
    Route::post('/game/commit', 'checkIfAnswerIsCorrect')->middleware('auth');
});
