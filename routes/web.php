<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\ChefController;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\EventController;
use App\Http\Controllers\Backend\ImageController;
use App\Http\Controllers\Backend\VideoController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('panel')->middleware('auth')->group(function() {
    Route::get('/dashboard', function () {
        return view('backend.dashboard.index');
    })->name('dashboard');

    Route::resource('image', ImageController::class)->names('panel.image');
    Route::resource('menu', MenuController::class)->names('panel.menu');
    Route::resource('event', EventController::class)->names('panel.event');
    Route::resource('video', VideoController::class)->names('panel.video');
    Route::resource('chef', ChefController::class)->names('panel.chef');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
