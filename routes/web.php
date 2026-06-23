<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\CheckoutController;

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminTransactionsController;
use App\Http\Controllers\Admin\EventController as AdminEventResourceController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index']);

Route::get('/events/{event}', [EventController::class, 'show'])
    ->name('events.show');

Route::get('/ticket', [TicketController::class, 'index']);

/*
|--------------------------------------------------------------------------
| Checkout Routes (PUBLIC)
|--------------------------------------------------------------------------
*/

Route::get('/checkout/{event}', [CheckoutController::class, 'create'])
    ->name('checkout.create');

Route::post('/checkout/{event}', [CheckoutController::class, 'store'])
    ->name('checkout.store');

/*
|--------------------------------------------------------------------------
| Partner Routes
|--------------------------------------------------------------------------
*/

Route::get('/admin/partners', [PartnerController::class, 'index']);
Route::get('/admin/partners/create', [PartnerController::class, 'create']);
Route::post('/admin/partners/store', [PartnerController::class, 'store']);
Route::get('/admin/partners/{id}/edit', [PartnerController::class, 'edit']);
Route::put('/admin/partners/{id}', [PartnerController::class, 'update']);
Route::delete('/admin/partners/{id}', [PartnerController::class, 'destroy']);

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.post');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});

/*
|--------------------------------------------------------------------------
| Protected Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('events', AdminEventResourceController::class);

        Route::resource('categories', CategoryController::class);

        Route::get('/transactions', [AdminTransactionsController::class, 'index'])
            ->name('transactions.index');
    });