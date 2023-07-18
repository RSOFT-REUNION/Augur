<?php

use App\Http\Controllers\Back\BackController;
use App\Http\Controllers\Back\LabelController;
use App\Http\Controllers\Back\PagesController;
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
/*Route::get('/mail', function () {
    $markdown = new \Illuminate\Mail\Markdown(view(), config('mail.markdown'));
    return $markdown->render('emails.support.message');
});*/
Route::post('/update-screensize', 'ScreenSizeController@update')->name('update-screensize');

Route::post('/consent', [FrontController::class, 'consentCookie'])->name('consent');
Route::get('/maintenance', [FrontController::class, 'showMaintenance'])->name('maintenance');
Route::post('/maintenance', [FrontController::class, 'connectMaintenance']);

Route::group([
    'middleware' => 'App\Http\Middleware\Maintenance',
], function () {
    Route::get('/', [FrontController::class, 'showHome'])->name('fo.home');
    Route::get('/mentions-legales', [FrontController::class, 'showLegalMentions'])->name('fo.legal');
    Route::get('/conditions-generales-utilisation', [FrontController::class, 'showConditions'])->name('fo.conditions');
    Route::get('/connexion-inscription', [FrontController::class, 'showSign'])->name('fo.sign');
    Route::post('/connexion-inscription', [FrontController::class, 'handleSignAction'])->name('fo.sign.handle');
    Route::get('/contactez-nous', [FrontController::class, 'showContact'])->name('fo.contact');
    Route::post('/contactez-nous', [FrontController::class, 'postContact']);
    Route::get('/nos-animations', [FrontController::class, 'showEvenementPage'])->name('fo.evenements');
    Route::get('/labels', [FrontController::class, 'showLabelList'])->name('fo.labels.list');
    Route::get('/labels/{slug}', [FrontController::class, 'showLabelSingle'])->name('fo.label');
    Route::get('/nos-magasins', [FrontController::class, 'showShopList'])->name('fo.shops.list');
    Route::get('/qui-sommes-nous', [FrontController::class, 'showAbout'])->name('fo.about');
    Route::get('/produits', [FrontController::class, 'showProductList'])->name('fo.products');
    Route::get('/produits/{id}', [FrontController::class, 'showListProduct'])->name('fo.products.list');

    Route::group([
        'middleware' => 'App\Http\Middleware\Users'
    ], function () {
        Route::get('/deconnexion', [FrontController::class, 'logout'])->name('logout');
        Route::get('/mon-profil', [FrontController::class, 'showProfile'])->name('fo.profile');
        Route::get('/suppression-de-mes-données', [FrontController::class, 'deletedAccount'])->name('account.delete');
    });

    Route::group([
        'middleware' => 'App\Http\Middleware\Teams',
    ], function (){
        Route::prefix('/espace-personnel')->group(function () {
            Route::get('/', [BackController::class, 'showDashboard'])->name('bo.dashboard');
            Route::get('/a-propos', [BackController::class, 'showAboutWebsite'])->name('bo.about');
            Route::get('/clients', [BackController::class, 'showCustomerList'])->name('bo.customers');
            Route::get('/clients/{id}', [BackController::class, 'showCustomerSingle'])->name('bo.customers.single');
            Route::get('/animations', [BackController::class, 'showEvenements'])->name('bo.evenements');
            Route::get('/animations/modification-{id}', [BackController::class, 'showEditEvenements'])->name('bo.evenements.edit');
            Route::post('/animations/modification-{id}', [BackController::class, 'editEvenements'])->name('bo.evenements.edit.post');
            Route::get('/labels-&-engagements', [LabelController::class, 'showList'])->name('bo.labels');
            Route::get('/labels-&-engagements/creation', [LabelController::class, 'showAdd'])->name('bo.labels.add');
            Route::post('/labels-&-engagements/creation', [LabelController::class, 'create'])->name('bo.labels.add.post');
            Route::get('/labels-&-engagements/modification/{id}', [LabelController::class, 'showEdit'])->name('bo.labels.edit');
            Route::post('/labels-&-engagements/modification/{id}', [LabelController::class, 'edit'])->name('bo.labels.edit.post');
            Route::get('/produits', [BackController::class, 'showProducts'])->name('bo.products.list');
            Route::get('/reglages-general', [SettingController::class, 'showGeneralSetting'])->name('bo.setting.general');
            Route::get('/reglages-magasins', [SettingController::class, 'showShopSetting'])->name('bo.setting.shop');
            Route::get('/reglages-informations', [SettingController::class, 'showInformations'])->name('bo.setting.infos');
            Route::get('/reglages-magasins/create-part-2-{id}', [SettingController::class, 'showShopCreatePart2'])->name('bo.setting.shop.create');
            Route::post('/reglages-magasins/create-part-2-{id}', [SettingController::class, 'postShopCreatePart2']);
            Route::get('/reglages-mentions-legales', [SettingController::class, 'showLegalMentions'])->name('bo.setting.legal');
            Route::post('/reglages-mentions-legales', [SettingController::class, 'postLegalMention']);
            Route::get('/reglages-cgu', [SettingController::class, 'showConditions'])->name('bo.setting.conditions');
            Route::post('/reglages-cgu', [SettingController::class, 'postConditions']);
            Route::get('/mes-pages', [PagesController::class, 'showGeneral'])->name('bo.pages.general');
            Route::get('/mes-pages/a-propos', [PagesController::class, 'showAbout'])->name('bo.pages.about');
            Route::post('/mes-pages/a-propos', [PagesController::class, 'postAbout']);
            Route::get('/mes-pages/accueil', [PagesController::class, 'showHome'])->name('bo.pages.home');
            Route::post('/mes-pages/accueil', [PagesController::class, 'postHome']);
            Route::get('/recettes', [BackController::class, 'showRecettes'])->name('bo.recette');
            Route::get('/recettes/ajout', [BackController::class, 'showAddRecettes'])->name('bo.recette.add');
            Route::get('/equipe', [BackController::class, 'showTeam'])->name('bo.team');
            Route::get('/medias', [BackController::class, 'showMedias'])->name('bo.media');
        });
    });
});




