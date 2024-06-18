<?php

use App\Http\Controllers\Frontend\AnimationsController;
use App\Http\Controllers\Frontend\Catalog\ShopsController;
use App\Http\Controllers\Frontend\LabelsController;
use Illuminate\Support\Facades\Route;
$idRegex = '[0-9]+';
$slugRegex = '[0-9a-z\-/]+';

/*** Label ***/
Route::get('/nos-labels', [LabelsController::class, 'index'] )->name('labels.index');
Route::get('/nos-labels/{label}-{slug}', [LabelsController::class, 'show'] )->name('labels.show')->where(['label' => $idRegex,'slug' => $slugRegex,]);

/*** Animation ***/
Route::get('/nos-animations', [AnimationsController::class, 'index'] )->name('animations.index');

/*** Magasin ***/
Route::get('/nos-magasins', [ShopsController::class, 'index'] )->name('shops.index');
