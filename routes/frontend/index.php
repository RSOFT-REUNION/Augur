<?php
/***************
 * Frontend ***
 * ************/
use App\Http\Controllers\Frontend\FrontController;
use App\Http\Controllers\Frontend\LabelsController;
use App\Http\Controllers\Frontend\ProfileController;
use Illuminate\Support\Facades\Route;
$idRegex = '[0-9]+';
$slugRegex = '[0-9a-z\-/]+';

/*** Home ***/
Route::get('/', [FrontController::class, 'index'] )->name('index');
Route::get('/mentions-legales', [FrontController::class, 'legalnotice'] )->name('legalnotice');
Route::get('/conditions-generales-d-utilisation', [FrontController::class, 'termsofservice'] )->name('termsofservice');
require __DIR__ . '/auth.php';

/*** Label ***/
Route::get('/nos-labels', [LabelsController::class, 'index'] )->name('labels.index');
Route::get('/nos-labels/{label}-{slug}', [LabelsController::class, 'show'] )->name('labels.show')->where([
    'label' => $idRegex,
    'slug' => $slugRegex,
]);;

/*** Login ***/
Route::middleware('auth', 'verified')->group(function () {
    Route::get('/mon-compte', [ProfileController::class, 'index'] )->name('dashboard');
    Route::get('/mon-compte/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/mon-compte/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/mon-compte/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
