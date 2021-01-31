<?php

// namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CountryController;

Route::prefix('/admin')->group(function(){
    // Route::get('/', [DashboardController::class,'getDashboard']);

    Route::get('/users',[UserController::class,'getUsers']);

    //Module Products-
    Route::get('/products', [ProductController::class,'getHome']
    );
    Route::get('/products/add', [ProductController::class,'getProductAdd']);
    Route::post('/products/add', [ProductController::class,'postProductAdd']);
    Route::get('/product/{idMarca}/edit',[ProductController::class,'getProductEdit']);
    Route::post('/products/{id}/edit', [ProductController::class,'postProductEdit']);
    Route::post('/products/{id}/gallery/add', [ProductController::class, 'postProductGalleryAdd']);

    //Module Categories
    Route::get('/categories/{module}', [CategoryController::class,'getHome']);
    Route::post('/categories/add', [CategoryController::class,'categoryAdd']);
    Route::get('/categories/{id}/edit', [CategoryController::class,'getCategoryEdit']);
    Route::post('/categories/{id}/edit', [CategoryController::class,'postCategoryEdit']);
    Route::get('/categories/{id}/delete', [CategoryController::class,'getCategoryDelete']);

    //map module
    Route::get('/location', 'MapController@getLocation')->name('location');

    Route::get('/countries', [CountryController::class, 'index']);
    Route::get('/countries/add', [CountryController::class, 'create']);
    Route::post('/countries/add', [CountryController::class, 'store']);
    // Route::get('/modificarCategoria/{idCategoria}', [CategoriaController::class, 'edit']);
    // Route::post('/modificarCategoria/{idCategoria}', [CategoriaController::class, 'update']);
});
