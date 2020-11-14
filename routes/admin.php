<?php

Route::prefix('/admin')->group(function(){
    Route::get('/', 'Admin\DashboardController@getDashboard');
    Route::get('/users','Admin\UserController@getUsers');

    //Module Products-
    Route::get('/products', 'Admin\ProductController@getHome');
    Route::get('/products/add', 'Admin\ProductController@getProductAdd');

    //Module Categories
    Route::get('/categories/{module}', 'Admin\CategoryController@getHome');
    Route::post('/categories/add', 'Admin\CategoryController@categoryAdd');
});
