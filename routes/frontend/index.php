<?php
/***************
 * Frontend ***
 * ************/
use App\Http\Controllers\Frontend\FrontController;
use App\Http\Controllers\Frontend\ProfileController;
use Illuminate\Support\Facades\Route;
$idRegex = '[0-9]+';
$slugRegex = '[0-9a-z\-/]+';

/*** Home ***/
Route::get('/', [FrontController::class, 'index'] )->name('index');

/*** Login ***/
Route::middleware('auth')->group(function () {
    Route::get('/mon-compte', [ProfileController::class, 'index'] )->name('dashboard');
    Route::get('/mon-compte/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/mon-compte/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/mon-compte/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__ . '/auth.php';
