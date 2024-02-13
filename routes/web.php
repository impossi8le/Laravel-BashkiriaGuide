<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});



Route::resource('places', App\Http\Controllers\App\PlacesController::class)->names('app.places');
Route::get('/search', [App\Http\Controllers\App\PlacesController::class, 'search'])->name('app.search');
Route::get('/map', [App\Http\Controllers\App\PlacesController::class, 'map'])->name('app.map');
Route::get('/maps', [App\Http\Controllers\App\PlacesController::class, 'maps'])->name('app.maps');





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');





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