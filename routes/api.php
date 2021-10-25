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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'category', 'namespace' => 'API'], function () {
    Route::get('category-list', 'APIController@categoryList');
    Route::post('category-create', 'APIController@createCategory');
    Route::get('category-details/{id}', 'APIController@detailCategory');
    Route::get('category-delete/{id}', 'APIController@deleteCategory');
    Route::post('category-update', 'APIController@updateCategory');

});

Route::group(['prefix' => 'pizza', 'namespace' => 'API'], function () {
    Route::get('pizza-list', 'PizzaController@getPizza');
});
