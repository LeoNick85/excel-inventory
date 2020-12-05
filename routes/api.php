<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route to upload data through Excel import
Route::post('/upload','App\Http\Controllers\ProductsController@import');

//Route to receive the list of available categories
Route::post('/category-list','App\Http\Controllers\CategoriesController@categoriesList');

//Route to update catogories with new discount rates
Route::post('/category-update','App\Http\Controllers\CategoriesController@categoriesUpdate');

//Route to search products via name or product code
Route::post('/search','App\Http\Controllers\ProductsController@search');
