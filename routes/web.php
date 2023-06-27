<?php

use App\Http\Controllers\Back\BackController;
use App\Http\Controllers\Back\LabelController;
use App\Http\Controllers\Back\SettingController;
use App\Http\Controllers\Front\FrontController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/maintenance', [FrontController::class, 'showMaintenance']);

Route::get('/', [FrontController::class, 'showHome'])->name('fo.home');
Route::get('/connexion-inscription', [FrontController::class, 'showSign'])->name('fo.sign');
Route::post('/connexion-inscription', [FrontController::class, 'handleSignAction'])->name('fo.sign.handle');
Route::get('/contactez-nous', [FrontController::class, 'showContact'])->name('fo.contact');
Route::post('/contactez-nous', [FrontController::class, 'postContact']);

Route::group([
    'middleware' => 'App\Http\Middleware\Users'
], function () {
    Route::get('/deconnexion', [FrontController::class, 'logout'])->name('logout');
    Route::get('/mon-profil', [FrontController::class, 'showProfile'])->name('fo.profile');
});

Route::group([
    'middleware' => 'App\Http\Middleware\Teams'
], function (){
    Route::prefix('/espace-personnel')->group(function () {
        Route::get('/', [BackController::class, 'showDashboard'])->name('bo.dashboard');
        Route::get('/clients', [BackController::class, 'showCustomerList'])->name('bo.customers');
        Route::get('/clients/{id}', [BackController::class, 'showCustomerSingle'])->name('bo.customers.single');
        Route::get('/animations', [BackController::class, 'showEvenements'])->name('bo.evenements');
        Route::get('/labels-&-engagements', [LabelController::class, 'showList'])->name('bo.labels');
        Route::get('/labels-&-engagements/creation', [LabelController::class, 'showAdd'])->name('bo.labels.add');
        Route::post('/labels-&-engagements/creation', [LabelController::class, 'create'])->name('bo.labels.add.post');
        Route::get('/labels-&-engagements/modification/{id}', [LabelController::class, 'showEdit'])->name('bo.labels.edit');
        Route::post('/labels-&-engagements/modification/{id}', [LabelController::class, 'edit'])->name('bo.labels.edit.post');
        Route::get('/produits', [BackController::class, 'showProducts'])->name('bo.products.list');
        Route::get('/reglages-general', [SettingController::class, 'showGeneralSetting'])->name('bo.setting.general');
        Route::get('/reglages-magasins', [SettingController::class, 'showShopSetting'])->name('bo.setting.shop');
        Route::get('/reglages-magasins/create-part-2-{id}', [SettingController::class, 'showShopCreatePart2'])->name('bo.setting.shop.create');
        Route::post('/reglages-magasins/create-part-2-{id}', [SettingController::class, 'postShopCreatePart2']);
    });
});


