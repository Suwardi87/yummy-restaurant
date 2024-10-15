<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\Backend\ChefController;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\EventController;
use App\Http\Controllers\Backend\ImageController;
use App\Http\Controllers\Backend\VideoController;
use App\Http\Controllers\Frontend\MainController;
use App\Http\Controllers\Frontend\ReviewController as FrontReviewController;
use App\Http\Controllers\Backend\ReviewController;
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\TransactionController;

Route::get('/', MainController::class);

Route::post('booking', [BookingController::class, 'store'])->name('book.attempt');
Route::post('review', [FrontReviewController::class, 'store'])->name('review.attempt');
Route::prefix('panel')->middleware('auth')->group(function() {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('panel.dashboard');

    Route::resource('image', ImageController::class)->names('panel.image');
    Route::resource('menu', MenuController::class)->names('panel.menu');
    Route::resource('event', EventController::class)->names('panel.event');
    Route::resource('video', VideoController::class)->names('panel.video');
    Route::resource('chef', ChefController::class)->names('panel.chef');

    // Hanya untuk owner: hanya bisa melihat transaksi dan download
    Route::middleware([RoleMiddleware::class . ':owner,operator'])->group(function() {
        Route::get('transaction', [TransactionController::class, 'index'])->name('panel.transaction.index');
        Route::post('transaction', [TransactionController::class, 'download'])->name('panel.transaction.download');
        Route::get('transaction/{transaction}', [TransactionController::class, 'show'])->name('panel.transaction.show');
    });


    // Review bisa diakses oleh operator dan owner
    Route::resource('review', ReviewController::class)->names('panel.review');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
