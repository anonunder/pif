<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IngredientsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManufacturersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/help', [HomeController::class, 'help'])->name('help');

Route::get('/test/ASFKDfokpsapSOfa', [HomeController::class, 'test'])->name('test');
Route::get('/locale/{lang}', [HomeController::class, 'setLocale'])->name('setLocale');

// Ingredients - Sastojci
Route::get('/ingredients', [IngredientsController::class, 'index'])->name('ingredients');
Route::get('/ingredients/add', [IngredientsController::class, 'addIndex'])->name('ingredientsAddIndex');
Route::get('/ingredients/edit/{id}', [IngredientsController::class, 'editIndex'])->name('ingredientsEditIndex');
Route::post('/ingredients/store', [IngredientsController::class, 'store'])->name('ingrediendsStore');
Route::post('/ingredients/get', [IngredientsController::class, 'ingredientGet'])->name('ingredientGet');

// Chapters - Sadrzaj
Route::get('/chapters', [HomeController::class, 'chapters'])->name('chapters');
Route::get('/chapters/get', [HomeController::class, 'chaptersGet'])->name('chaptersGet');
Route::post('/chapter/get', [HomeController::class, 'chapterGet'])->name('chapterGet');
Route::post('/chapter/save', [HomeController::class, 'chapterSave'])->name('chapterSave');
Route::post('/chapter/row/update', [HomeController::class, 'chapterRowUpdate'])->name('chapterRowUpdate');

// Companies - Firme
Route::get('/companies', [ManufacturersController::class, 'companies'])->name('companies');
Route::get('/companies/get', [ManufacturersController::class, 'companiesGet'])->name('companiesGet');
Route::post('/company/get', [ManufacturersController::class, 'companyGet'])->name('companyGet');
Route::post('/companies/save', [ManufacturersController::class, 'companiesSave'])->name('companiesSave');
Route::post('/companies/delete', [ManufacturersController::class, 'companiesDelete'])->name('companiesDelete');

// Manufacturer - Proizvodjaci
Route::get('/manufacturers', [ManufacturersController::class, 'manufacturers'])->name('manufacturers');
Route::get('/manufacturers/get', [ManufacturersController::class, 'manufacturersGet'])->name('manufacturersGet');
Route::post('/manufacturer/get', [ManufacturersController::class, 'manufacturerGet'])->name('manufacturerGet');
Route::post('/manufacturers/save', [ManufacturersController::class, 'manufacturersSave'])->name('manufacturersSave');
Route::post('/manufacturers/delete', [ManufacturersController::class, 'manufacturersDelete'])->name('manufacturersDelete');

// Distributor - Distributer
Route::get('/distributors', [ManufacturersController::class, 'distributors'])->name('distributors');
Route::get('/distributors/get', [ManufacturersController::class, 'distributorsGet'])->name('distributorsGet');
Route::post('/distributor/get', [ManufacturersController::class, 'distributorGet'])->name('distributorGet');
Route::post('/distributors/save', [ManufacturersController::class, 'distributorsSave'])->name('distributorsSave');
Route::post('/distributors/delete', [ManufacturersController::class, 'distributorsDelete'])->name('distributorsDelete');

// Products - Proizvodi
Route::get('/products', [ProductsController::class, 'index'])->name('products');
Route::get('/products/add', [ProductsController::class, 'addIndex'])->name('productsAddIndex');
Route::get('/products/edit/{id}', [ProductsController::class, 'editIndex'])->name('productsEditIndex');
Route::post('/products/store', [ProductsController::class, 'store'])->name('productsStore');
Route::post('/products/aneks/upload', [ProductsController::class, 'aneksUpload'])->name('aneksUpload');
Route::post('/products/specification/upload', [ProductsController::class, 'specUpload'])->name('specUpload');
Route::post('/products/aneks/remove', [ProductsController::class, 'aneksRemove'])->name('aneksRemove');
Route::get('/product/replicate/{id}', [ProductsController::class, 'replicate'])->name('replicate');
Route::post('/products/aneks/fetch', [ProductsController::class, 'aneksFetch'])->name('aneksFetch');
Route::post('/remove/file', [ProductsController::class, 'removeFile'])->name('removeFile');
Route::get('/products/get', [ProductsController::class, 'productsGet'])->name('productsGet');

// PDF - PDF Generator
Route::get('/product/pdf/viewer/{id}', [ProductsController::class, 'pdfViewer'])->name('pdfViewer');
Route::get('/product/pdf/preview/{id}', [PDFController::class, 'pdfPreview'])->name('pdfPreview');
Route::get('/product/pdf/generate/{id}', [PDFController::class, 'pdfGenerate'])->name('pdfGenerate');


// Mixing - Smese
Route::get('/mixtures', [ProductsController::class, 'mixturesIndex'])->name('mixtures');
Route::get('/mixtures/add', [ProductsController::class, 'mixturesAddIndex'])->name('mixturesAddIndex');
Route::get('/mixtures/edit/{id}', [ProductsController::class, 'mixturesEditIndex'])->name('mixturesEditIndex');
Route::get('/mixtures/get', [ProductsController::class, 'mixturesAll'])->name('mixturesAll');
Route::post('/mixtures/store', [ProductsController::class, 'mixtureStore'])->name('mixtureStore');
Route::get('/mixture/delete/{id}', [ProductsController::class, 'mixtureDelete'])->name('mixtureDelete');



// Product - Mixture Save & Load
Route::post('/product/mixture/save', [ProductsController::class, 'mixtureSave'])->name('mixtureSave');
Route::post('/product/mixture/render', [ProductsController::class, 'mixtureRender'])->name('mixtureRender');
Route::get('/product/mixtures/get', [ProductsController::class, 'mixturesGet'])->name('mixturesGet');


// Users - Korisnici
Route::get('/users', [UserController::class, 'users'])->name('users');
Route::get('/users/get', [UserController::class, 'usersGet'])->name('usersGet');
Route::post('/users/store', [UserController::class, 'userStore'])->name('userStore');
Route::get('/users/edit/{id}', [UserController::class, 'userEdit'])->name('userEdit');
Route::get('/users/add', [UserController::class, 'userAdd'])->name('userAdd');


// Users - Company Clients
Route::get('/products/list', [ClientController::class, 'client_products'])->name('client_products');
Route::get('/product/view/{id}', [ClientController::class, 'productView'])->name('productView');
Route::get('/client/products/get', [ClientController::class, 'clientProductsGet'])->name('clientProductsGet');



 //Clear route cache
 Route::get('/route-cache', function() {
    \Artisan::call('route:cache');
    return 'Routes cache cleared';
});

//Clear config cache
Route::get('/config-cache', function() {
    \Artisan::call('config:cache');
    return 'Config cache cleared';
}); 

// Clear application cache
Route::get('/clear-cache', function() {
    \Artisan::call('cache:clear');
    return 'Application cache cleared';
});

// Clear view cache
Route::get('/view-clear', function() {
    \Artisan::call('view:clear');
    return 'View cache cleared';
});

// Clear cache using reoptimized class
Route::get('/optimize-clear', function() {
    \Artisan::call('optimize:clear');
    return 'View cache cleared';
});