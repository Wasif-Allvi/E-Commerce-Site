<?php

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

Route::get('/', 'Frontend\PagesController@index')->name('index');

Route::get('/contact', 'Frontend\PagesController@contact')->name('contact');


Route:: group(['prefix' => 'products'], function(){

Route::get('/', 'Frontend\ProductsController@index')->name('products');

Route::get('/{slug}', 'Frontend\ProductsController@show')->name('products.show');

Route::get('/search', 'Frontend\PagesController@search')->name('search');

Route::get('/categories', 'Frontend\CategoriesController@index')->name('categories.index');

Route::get('/category/{id}', 'Frontend\CategoriesController@show')->name('categories.show');

});

//Admin Routes

Route:: group(['prefix' => 'admin'], function(){
	Route::get('/', 'Backend\PagesController@index')->name('admin.index');



	Route:: group(['prefix' => '/products'], function(){

		//Product Routes

		Route::get('/', 'Backend\ProductsController@index')->name('admin.products');

		Route::get('/create', 'Backend\ProductsController@create')->name('admin.product.create');

		Route::get('/edit{id}', 'Backend\ProductsController@edit')->name('admin.product.edit');

		Route::post('/store', 'Backend\ProductsController@store')->name('admin.product.store');

		Route::post('/product/edit{id}', 'Backend\ProductsController@update')->name('admin.product.update');

		Route::post('/product/delete{id}', 'Backend\ProductsController@delete')->name('admin.product.delete');

	});

//Category Routes

	Route:: group(['prefix' => '/categories'], function(){

		

		Route::get('/', 'Backend\CategoriesController@index')->name('admin.categories');

		Route::get('/create', 'Backend\CategoriesController@create')->name('admin.category.create');

		Route::get('/edit{id}', 'Backend\CategoriesController@edit')->name('admin.category.edit');

		Route::post('/store', 'Backend\CategoriesController@store')->name('admin.category.store');

		Route::post('/category/edit{id}', 'Backend\CategoriesController@update')->name('admin.category.update');

		Route::post('/category/delete{id}', 'Backend\CategoriesController@delete')->name('admin.category.delete');

	});


	Route:: group(['prefix' => '/brands'], function(){

		//Brand Routes

		Route::get('/', 'Backend\BrandsController@index')->name('admin.brands');

		Route::get('/create', 'Backend\BrandsController@create')->name('admin.brand.create');

		Route::get('/edit{id}', 'Backend\BrandsController@edit')->name('admin.brand.edit');

		Route::post('/store', 'Backend\BrandsController@store')->name('admin.brand.store');

		Route::post('/brand/edit{id}', 'Backend\BrandsController@update')->name('admin.brand.update');

		Route::post('/brand/delete{id}', 'Backend\BrandsController@delete')->name('admin.brand.delete');

	});



	


});

