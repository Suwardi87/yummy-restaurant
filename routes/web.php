<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\ImageController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('panel')->middleware('auth')->group(function() {
    Route::get('/dashboard', function () {
        return view('backend.dashboard.index');
    })->name('dashboard');

    Route::resource('image', ImageController::class)->names('panel.image');
    Route::resource('menu', MenuController::class)->names('panel.menu');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
