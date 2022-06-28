<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TestController;
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
    Route::get('/all','index')->name('student.index');
    Route::get('/','show')->name('student.show');
    Route::get('create','create')->name('student.create');
    Route::post('/','store')->name('student.store');
    Route::patch('/','update')->name('student.update');
    Route::delete('/','destroy')->name('student.destroy');
});

Route::controller(QuestionController::class)->prefix('question')->group(function(){
    Route::get('/','index')->name('question.index');
});

Route::controller(AnswerController::class)->prefix('answer')->group(function(){
    Route::get('/','index')->name('answer.index');
    Route::post('/','store')->name('answer.store');
});

Route::controller(TestController::class)->prefix('test')->group(function(){
    Route::get('/result','show')->name('test.result');
    Route::post('/submit','submit')->name('test.submit');
});
