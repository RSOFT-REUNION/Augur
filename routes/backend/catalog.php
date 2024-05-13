<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Catalog\ProductController;
use App\Http\Controllers\Backend\Catalog\CategoryController;
use App\Http\Controllers\Backend\Catalog\BrandsController;
use App\Http\Controllers\Backend\Catalog\ShopsController;

$idRegex = '[0-9]+';
$slugRegex = '[0-9a-z\-/]+';

Route::prefix('admin/catalogue')->name('backend.catalog.')->middleware('auth:admin')->group(function () use ($idRegex, $slugRegex) {
    Route::group(['middleware' => ['permission:catalog.products.create|catalog.products.update|catalog.products.delete']], function () use ($idRegex) {
        Route::resource('products', ProductController::class)->except(['show']);
        Route::post('products/addimages/{product}', [ProductController::class, 'add_image'])->name('products.add_image')->where(['product' => $idRegex]);
        Route::delete('products/images/{image}', [ProductController::class, 'destroy_image'])->name('products.destroy_image')->where(['image' => $idRegex]);
        Route::put('products/images/{image}', [ProductController::class, 'fav_image'])->name('products.fav_image')->where(['image' => $idRegex]);
    });
    Route::group(['middleware' => ['permission:catalog.categories.create|catalog.categories.update|catalog.categories.delete']], function () {
        Route::resource('categories', CategoryController::class)->except(['show']);
    });
    Route::group(['middleware' => ['permission:catalog.brands.create|catalog.brands.update|catalog.brands.delete']], function () {
        Route::resource('brands', BrandsController::class)->except(['show']);
    });
    Route::group(['middleware' => ['permission:catalog.shops.create|catalog.shops.update|catalog.shops.delete']], function () {
        Route::resource('shops', ShopsController::class)->except(['show']);
    });
});
