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

Route::post('/upload','App\Http\Controllers\ProductsController@import');

Route::post('/category-list','App\Http\Controllers\CategoriesController@categoriesList');

Route::post('/category-update','App\Http\Controllers\CategoriesController@categoriesUpdate');
