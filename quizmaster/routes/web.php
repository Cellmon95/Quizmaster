<?php

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

Route::get('menu', function(){
    return view('mainMenu');
})->middleware('auth');
