<?php

use App\Http\Controllers\Frontend\Orders\OrdersController;
use Illuminate\Support\Facades\Route;

$idRegex = '[0-9]+';
$slugRegex = '[0-9a-z\-/]+';

Route::post('/cart_validation', [OrdersController::class, 'cart_validation'])->name('orders.cart_validation');
