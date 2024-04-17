<?php
/***************
 * Backend ***
 * ************/
use App\Http\Controllers\Backend\Catalog\BrandsController;
use App\Http\Controllers\Backend\Catalog\CategoryController as CategoriesController;
use App\Http\Controllers\Backend\Catalog\ProductsController;
use App\Http\Controllers\Backend\Catalog\ShopsController;
use App\Http\Controllers\Backend\Catalog\StocksController;
use App\Http\Controllers\Backend\Clients\ClientsController;
use App\Http\Controllers\Backend\Content\CarouselController;
use App\Http\Controllers\Backend\Content\CategoryController;
use App\Http\Controllers\Backend\Content\PagesController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\Settings\Information;
use App\Http\Controllers\Backend\Settings\Teams\AdministratorsController;
use App\Http\Controllers\Backend\Settings\Teams\RolesController;
use App\Http\Controllers\Backend\Specific\AnimationsController;
use App\Http\Controllers\Backend\Specific\LabelsController;
use Illuminate\Support\Facades\Route;
$idRegex = '[0-9]+';
$slugRegex = '[0-9a-z\-/]+';

/***************
 * /Admin ***
 * ************/

/*** Login ***/
Route::get('/admin', [DashboardController::class, 'index'])->middleware(['auth:admin', 'verified'])->name('backend.dashboard');
require __DIR__ . '/auth.php';

/*** Content ***/
Route::prefix('admin/contenu')->name('backend.content.')->middleware('auth:admin')->group(function () use ($idRegex, $slugRegex) {
    Route::group(['middleware' => ['permission:content.categories.create|content.categories.update|content.categories.delete']], function () {
        Route::resource('categories', CategoryController::class)->except(['show']);
    });
    Route::group(['middleware' => ['permission:content.pages.create|content.pages.update|content.pages.delete']], function () {
        Route::resource('pages', PagesController::class)->except(['show']);
    });
    Route::group(['middleware' => ['permission:carousel.pages.create|content.carousel.update|content.carousel.delete']], function () {
        Route::resource('carrousel', CarouselController::class)->except(['show']);
    });
});

/*** Catalog ***/
Route::prefix('admin/catalog')->name('backend.catalog.')->middleware('auth:admin')->group(function () use ($idRegex, $slugRegex) {
    Route::group(['middleware' => ['permission:catalog.categories.create|catalog.categories.update|catalog.categories.delete']], function () {
        Route::resource('categories', CategoriesController::class)->except(['show']);
    });
    Route::group(['middleware' => ['permission:catalog.products.create|catalog.products.update|catalog.products.delete']], function () {
        Route::resource('products', ProductsController::class)->except(['show']);
    });
    Route::group(['middleware' => ['permission:catalog.brands.create|catalog.brands.update|catalog.brands.delete']], function () {
        Route::resource('brands', BrandsController::class)->except(['show']);
    });
    Route::group(['middleware' => ['permission:catalog.stocks.create|catalog.stocks.update|catalog.stocks.delete']], function () {
        Route::resource('stocks', StocksController::class)->except(['show']);
    });
    Route::group(['middleware' => ['permission:catalog.shops.create|catalog.shops.update|catalog.shops.delete']], function () {
        Route::resource('shops', ShopsController::class)->except(['show']);
    });
});
/*** Clients ***/
Route::prefix('admin/clients')->name('backend.clients.')->middleware('auth:admin')->group(function () use ($idRegex, $slugRegex) {
    Route::group(['middleware' => ['permission:clients.create|clients.update|clients.delete']], function () {
        Route::get('', [ClientsController::class, 'index'])->name('index');
        Route::delete('{client}', [ClientsController::class, 'destroy'])->name('destroy');
        Route::get('/adresses/{client}', [ClientsController::class, 'addresses'])->name('adresse');
    });
});

/*** specific ***/
Route::prefix('admin/specifique')->name('backend.specific.')->middleware('auth:admin')->group(function () use ($idRegex) {
    Route::group(['middleware' => ['permission:specific.labels.create|specific.labels.update|specific.labels.delete']], function () {
        Route::resource('labels', LabelsController::class)->except(['show']);
        Route::resource('animations', AnimationsController::class)->except(['show']);
    });
});

/*** settings ***/
Route::prefix('admin/parametres')->name('backend.settings.')->middleware('auth:admin')->group(function () use ($idRegex) {
    Route::prefix('/equipes')->name('teams.')->group(function () use ($idRegex) {
        Route::group(['middleware' => ['permission:settings.teams.roles.create|settings.teams.roles.update|settings.teams.roles.delete|permission:settings.teams.administrators.create|settings.teams.administrators.update|settings.teams.administrators.delete|settings.teams.administrators.changepassword']], function () {
            Route::get('/', function () { return view('backend.settings.teams.index');})->name('index');
            Route::group(['middleware' => ['permission:settings.teams.roles.create|settings.teams.roles.update|settings.teams.roles.delete']], function () {
                Route::resource('roles', RolesController::class)->except(['show']);
            });
            Route::group(['middleware' => ['permission:permission:settings.teams.administrators.create|settings.teams.administrators.update|settings.teams.administrators.delete|settings.teams.administrators.changepassword']], function () {
                Route::resource('administrators', AdministratorsController::class)->except(['show']);
                Route::put('administrators/{administrator}/changepassword', [AdministratorsController::class, 'changeMDP'])->name('administrators.changepassword');
            });
        });
    });
    Route::group(['middleware' => ['permission:settings.information.update']], function () {
        Route::get('informations', [Information::class, 'index'])->name('informations.index');
        Route::post('informations', [Information::class, 'update'])->name('informations.update');
        Route::get('mentions-legales', [Information::class, 'legalnoticeindex'])->name('legalnotice.index');
        Route::post('mentions-legales', [Information::class, 'legalnoticeupdate'])->name('legalnotice.update');
        Route::get('conditions-generales-dutilisation', [Information::class, 'termsofserviceindex'])->name('termsofservice.index');
        Route::post('conditions-generales-dutilisation', [Information::class, 'termsofserviceupdate'])->name('termsofservice.update');
    });
});

/*** Upload image depuis SummerNote ***/
Route::post('/', function () {
    if (request()->has('image')) {
        $file = request()->file('image');
        $name = $file->getClientOriginalName();
        $file->move(public_path('storage/upload/pages/'), $name);
        return asset('storage/upload/pages/' . $name);
    }
});
