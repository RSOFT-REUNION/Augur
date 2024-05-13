<?php

use App\Http\Controllers\Backend\Specific\AnimationsController;
use App\Http\Controllers\Backend\Specific\LabelsController;
use Illuminate\Support\Facades\Route;

$idRegex = '[0-9]+';
$slugRegex = '[0-9a-z\-/]+';

Route::prefix('admin/specifique')->name('backend.specific.')->middleware('auth:admin')->group(function () use ($idRegex) {
    Route::group(['middleware' => ['permission:specific.labels.create|specific.labels.update|specific.labels.delete']], function () {
        Route::resource('labels', LabelsController::class)->except(['show']);
        Route::resource('animations', AnimationsController::class)->except(['show']);
    });
});
