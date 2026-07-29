<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MidtransWebhookController;
use App\Http\Controllers\ReviewController;

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminTransactionsController;
use App\Http\Controllers\Admin\EventController as AdminEventResourceController;
use App\Http\Controllers\Admin\OrganizationController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/auth/google', [GoogleController::class, 'redirect'])
    ->name('google.login');

Route::get('/auth/google/callback', [GoogleController::class, 'callback'])
    ->name('google.callback');

Route::get('/logout/google', [GoogleController::class, 'logout'])
    ->name('google.logout');

Route::get('/', [HomeController::class, 'index']);

Route::get('/events/{event}', [EventController::class, 'show'])
    ->name('events.show');

Route::post('/events/{event}/review', [ReviewController::class, 'store'])
    ->middleware('auth')
    ->name('reviews.store');

Route::get('/ticket', [TicketController::class, 'index']);

/*
|--------------------------------------------------------------------------
| Checkout
|--------------------------------------------------------------------------
*/

Route::get('/checkout/{event}', [CheckoutController::class, 'create'])
    ->name('checkout.create');

Route::post('/checkout/{event}', [CheckoutController::class, 'store'])
    ->name('checkout.store');

Route::get('/payment/{order_id}', [CheckoutController::class, 'payment'])
    ->name('checkout.payment');

Route::get('/success/{order_id}', [CheckoutController::class, 'success'])
    ->name('checkout.success');

/*
|--------------------------------------------------------------------------
| Midtrans Callback
|--------------------------------------------------------------------------
*/

Route::post('/midtrans/callback', [MidtransWebhookController::class, 'handle']);

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/login', [AuthController::class, 'showLogin'])
            ->name('login');

        Route::post('/login', [AuthController::class, 'login'])
            ->name('login.post');

        Route::post('/logout', [AuthController::class, 'logout'])
            ->name('logout');
    });

/*
|--------------------------------------------------------------------------
| ADMIN & SUPER ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | Event
        |--------------------------------------------------------------------------
        */

        Route::resource('events', AdminEventResourceController::class);

        /*
        |--------------------------------------------------------------------------
        | Category
        |--------------------------------------------------------------------------
        */

        Route::resource('categories', CategoryController::class);

        /*
        |--------------------------------------------------------------------------
        | Partner
        |--------------------------------------------------------------------------
        */

        Route::get('/partners', [PartnerController::class, 'index'])
            ->name('partners.index');

        Route::get('/partners/create', [PartnerController::class, 'create'])
            ->name('partners.create');

        Route::post('/partners/store', [PartnerController::class, 'store'])
            ->name('partners.store');

        Route::get('/partners/{id}/edit', [PartnerController::class, 'edit'])
            ->name('partners.edit');

        Route::put('/partners/{id}', [PartnerController::class, 'update'])
            ->name('partners.update');

        Route::delete('/partners/{id}', [PartnerController::class, 'destroy'])
            ->name('partners.destroy');

        /*
        |--------------------------------------------------------------------------
        | Transaction
        |--------------------------------------------------------------------------
        */

        Route::get('/transactions', [AdminTransactionsController::class, 'index'])
            ->name('transactions.index');
    });

/*
|--------------------------------------------------------------------------
| SUPER ADMIN ONLY
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin', 'superadmin'])
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Organization
        |--------------------------------------------------------------------------
        */

        Route::resource('organizations', OrganizationController::class);

        /*
        |--------------------------------------------------------------------------
        | User Management
        |--------------------------------------------------------------------------
        */

        Route::resource('users', UserController::class);
    });