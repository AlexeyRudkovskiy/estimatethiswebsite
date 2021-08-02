<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrganisationController;
use App\Http\Middleware\SetDefaultOrganisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::name('api.')
    ->group(function () {
        Route::post('login', [ AuthController::class, 'login' ])->name('login');
        Route::post('register', [ AuthController::class, 'register' ])->name('register');

        Route::middleware('auth:sanctum')
            ->group(function () {
                Route::get('/me', [ AuthController::class, 'me' ])->name('me');

                Route::put('/organisation', [ OrganisationController::class, 'store' ])->name('organisation_create');

                Route::middleware(SetDefaultOrganisation::class)
                    ->prefix('organisation/{organisation_id}')
                    ->group(function() {
                        Route::post('/', [ OrganisationController::class, 'update' ])->name('organisation_update');
                        Route::delete('/', [ OrganisationController::class, 'destroy' ])->name('organisation_destroy');
                    });
            });
    });
