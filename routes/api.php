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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'articles', 'prefix' => 'articles','middleware'=>'auth:api'], function () {
    Route::get('/', [\App\Http\Controllers\Articles\ArticleController::class, 'index']);
    Route::put('/', [\App\Http\Controllers\Articles\ArticleController::class, 'store']);
    Route::get('/{article}', [\App\Http\Controllers\Articles\ArticleController::class, 'show']);
    Route::put('/{article}', [\App\Http\Controllers\Articles\ArticleController::class, 'update']);
    Route::delete('/{article}', [\App\Http\Controllers\Articles\ArticleController::class, 'destroy']);
});
