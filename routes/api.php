<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//get
Route::get('product/list', [RouteController::class, 'productList']);
Route::get('category/list', [RouteController::class, 'categoryList']);


//post
Route::post('create/category', [RouteController::class, 'createCategory']);
Route::post('create/contact', [RouteController::class, 'createContact']);

Route::post('delete/category', [RouteController::class, 'deleteCategory']);

Route::post('category/details', [RouteController::class, 'categoryDetails']);

Route::post('category/update', [RouteController::class, 'categoryUpdate']);
