<?php
use App\Http\Controllers\Frontend\ShoppingCart\CartController;
use Illuminate\Support\Facades\Route;

$idRegex = '[0-9]+';
$slugRegex = '[0-9a-z\-/]+';

Route::get('mon-panier', [CartController::class, 'index'])->name('cart.index');
Route::post('mon-panier/down_quantity_product/{produit}', [CartController::class, 'down_quantity_product'])->name('cart.down_quantity_product')->where(['produit' => $idRegex]);
Route::post('mon-panier/up_quantity_product/{produit}', [CartController::class, 'up_quantity_product'])->name('cart.up_quantity_product')->where(['produit' => $idRegex]);
Route::get('mon-panier/delete_product/{produit}', [CartController::class, 'delete_product'])->name('cart.delete_product')->where(['produit' => $idRegex]);
Route::post('mon-panier/add_product/{produit}', [CartController::class, 'add_product'])->name('cart.add_product')->where(['produit' => $idRegex]);

Route::post('mon-panier/chose_address', [CartController::class, 'chose_address'])->name('cart.chose_address');
Route::post('mon-panier/create_address', [CartController::class, 'create_address'])->name('cart.create_address');
Route::post('mon-panier/chose_delivery', [CartController::class, 'chose_delivery'])->name('cart.chose_delivery');
Route::post('mon-panier/paiement', [CartController::class, 'chose_payment'])->name('cart.chose_payment');
