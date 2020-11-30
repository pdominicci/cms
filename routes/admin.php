<?php
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->group(function(){
    Route::get('/', 'Admin\DashboardController@getDashboard');
    Route::get('/users','Admin\UserController@getUsers');

    //Module Products-
    Route::get('/products', 'Admin\ProductController@getHome');
    Route::get('/products/add', 'Admin\ProductController@getProductAdd');
    Route::post('/products/add', 'Admin\ProductController@postProductAdd');
    Route::get('/product/{idMarca}/edit','Admin\ProductController@getProductEdit');

    //Module Categories
    Route::get('/categories/{module}', 'Admin\CategoryController@getHome');
    Route::post('/categories/add', 'Admin\CategoryController@categoryAdd');
    Route::get('/categories/{id}/edit', 'Admin\CategoryController@getCategoryEdit');
    Route::post('/categories/{id}/edit', 'Admin\CategoryController@postCategoryEdit');
    Route::get('/categories/{id}/delete', 'Admin\CategoryController@getCategoryDelete');
});
