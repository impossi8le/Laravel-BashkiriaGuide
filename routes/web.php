<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




// Route::group(['middleware' => ['role:admin']], function () {
//     Route::get('/admin', [App\Http\Controllers\Admin\HomeController::class, 'index']);
// });

Route::middleware(['role:admin'])->prefix('admin_panel')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('homeAdmin_panel.home');

    Route::resource('articles', App\Http\Controllers\Admin\ArticlesController::class);
    Route::resource('routes', App\Http\Controllers\Admin\RoutesController::class);
    Route::resource('agencies', App\Http\Controllers\Admin\AgenciesController::class);
    Route::resource('categories', App\Http\Controllers\Admin\CategoriesController::class);
    Route::resource('organisations', App\Http\Controllers\Admin\OrganisationsController::class);
    Route::resource('places', App\Http\Controllers\Admin\PlacesController::class);

    Route::resource('attributes', App\Http\Controllers\Admin\AttributesController::class);
    Route::resource('locations', App\Http\Controllers\Admin\LocationsController::class);

    
});