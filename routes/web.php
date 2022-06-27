<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/dahboard', [DashboardController::class, 'index'])->name('dashboard');

Route::controller(StudentController::class)->prefix('student')->group(function(){
    Route::get('index','index')->name('student.index');
    Route::get('create','create')->name('student.create');
    Route::post('store','store')->name('student.store');
});