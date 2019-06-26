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

Route::get("/w", function() {
    return view("welcome");
});

Route::get("/", "HomeController@dashboard");

Route::get("/product/create", "ProductController@create");
Route::post("/product", "ProductController@insert");
Route::get("/product/{id}/edit", "ProductController@edit");
Route::put("/product", "ProductController@update");
Route::delete("/product", "ProductController@delete");
