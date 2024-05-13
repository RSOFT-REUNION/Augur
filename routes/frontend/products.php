<?php

use App\Http\Controllers\Frontend\FrontController;
use Illuminate\Support\Facades\Route;

$idRegex = '[0-9]+';
$slugRegex = '[0-9a-z\-/]+';

Route::get('/nos-produits/{slug}/{product}', [FrontController::class, 'product'] )->name('product.show')->where([
    'product' => $idRegex,
    'slug' => $slugRegex,
]);
