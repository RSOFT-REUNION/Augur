<?php

use App\Http\Controllers\Backend\Clients\ClientsController;
use Illuminate\Support\Facades\Route;

$idRegex = '[0-9]+';
$slugRegex = '[0-9a-z\-/]+';

Route::prefix('admin/clients')->name('backend.clients.')->middleware('auth:admin')->group(function () use ($idRegex, $slugRegex) {
    Route::prefix('/client')->name('client.')->group(function () {
        Route::group(['middleware' => ['permission:clients.client.show']], function () {
            Route::get('', [ClientsController::class, 'index'])->name('index');
            Route::delete('{client}', [ClientsController::class, 'destroy'])->name('destroy');
            Route::get('/adresses/{client}', [ClientsController::class, 'addresses'])->name('adresse');
            Route::post('importcsv', [ClientsController::class, 'importcsv'])->name('importcsv');
        });
    });
    Route::prefix('/paniers')->name('carts.')->group(function () {
        Route::group(['middleware' => ['permission:clients.carts.show']], function () {
            Route::get('', [ClientsController::class, 'carts_index'])->name('index');
        });
    });
});
