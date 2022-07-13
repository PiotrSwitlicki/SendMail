<?php

use Illuminate\Support\Facades\Route;
use App\Mail\TestEmail;


Auth::routes();
Route::get('/', [App\Http\Controllers\TodoController::class, 'index'])->name('main');
Route::get('/home', [App\Http\Controllers\TodoController::class, 'index']);
Route::post('/message/create', [App\Http\Controllers\TodoController::class, 'store'])->name('todostore');
Route::delete('/message/{message}', [App\Http\Controllers\TodoController::class, 'destroy'])->name('destroy');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



