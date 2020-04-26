<?php

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

Route::prefix('v1')->group(function () {
    Route::apiResource('document', 'API\V1\DocumentAPIController')
        ->except('destroy');
    Route::post('document/{document}/publish', 'API\V1\DocumentAPIController@publish');
});
