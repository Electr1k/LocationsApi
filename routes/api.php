<?php

use App\Http\Controllers\Api\Locations\IndexController;
use App\Http\Controllers\Api\Locations\StoreController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => 'api',
    'prefix' => 'locations'], function ($router){
    Route::get('/all', IndexController::class);
    Route::post('/', StoreController::class);

});
