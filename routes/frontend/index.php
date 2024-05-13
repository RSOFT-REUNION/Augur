<?php

use App\Http\Controllers\Frontend\AnimationsController;
use App\Http\Controllers\Frontend\FrontController;
use App\Http\Controllers\Frontend\LabelsController;
use Illuminate\Support\Facades\Route;
$idRegex = '[0-9]+';
$slugRegex = '[0-9a-z\-/]+';

require __DIR__ . '/auth.php';
require __DIR__ . '/products.php';
require __DIR__ . '/shopping_cart.php';

/*** Label ***/
Route::get('/nos-labels', [LabelsController::class, 'index'] )->name('labels.index');
Route::get('/nos-labels/{label}-{slug}', [LabelsController::class, 'show'] )->name('labels.show')->where([
    'label' => $idRegex,
    'slug' => $slugRegex,
]);
/*** Animation ***/
Route::get('/nos-animations', [AnimationsController::class, 'index'] )->name('animations.index');

/*** Home ***/
Route::get('/', [FrontController::class, 'index'] )->name('index');
if (Route::current() != '/admin') {
    Route::get('/mentions-legales', [FrontController::class, 'legalnotice'])->name('legalnotice');
    Route::get('/conditions-generales-d-utilisation', [FrontController::class, 'termsofservice'])->name('termsofservice');
    Route::get('{slug}', [FrontController::class, 'pages'])->name('pages')->where(['slug' => $slugRegex]);
}
