<?php

use App\Http\Controllers\Api\Locations\DestroyController;
use App\Http\Controllers\Api\Locations\IndexController;
use App\Http\Controllers\Api\Locations\StoreController;
use App\Http\Controllers\Api\Locations\TrashedController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => 'api',
    'prefix' => 'locations'], function ($router){
    Route::get('/all', IndexController::class);
    Route::get('/trashed', TrashedController::class);
    Route::post('/', StoreController::class);
    Route::delete('/{location}', DestroyController::class);

});
