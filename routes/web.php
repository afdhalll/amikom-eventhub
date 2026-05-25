<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PartnerController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminEventController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminTransactionsController;
use App\Http\Controllers\Admin\EventController as AdminEventResourceController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index']);

Route::get('/event-detail', [EventController::class, 'show']);

Route::get('/checkout', [EventController::class, 'checkout']);

Route::get('/ticket', [TicketController::class, 'index']);


/*
|--------------------------------------------------------------------------
| Partner Routes (CRUD)
|--------------------------------------------------------------------------
*/

// Read Data
Route::get('/admin/partners', [PartnerController::class, 'index']);

// Form Create
Route::get('/admin/partners/create', [PartnerController::class, 'create']);

// Simpan Data
Route::post('/admin/partners/store', [PartnerController::class, 'store']);

// Form Edit
Route::get('/admin/partners/{id}/edit', [PartnerController::class, 'edit']);

// Update Data
Route::put('/admin/partners/{id}', [PartnerController::class, 'update']);

// Delete Data
Route::delete('/admin/partners/{id}', [PartnerController::class, 'destroy']);


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Events CRUD
    Route::resource('events', AdminEventResourceController::class);

    // Categories CRUD
    Route::resource('categories', CategoryController::class);

    // Transactions
    Route::get('/transactions', [AdminTransactionsController::class, 'index'])
        ->name('transactions.index');

});