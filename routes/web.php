<?php

use App\Http\Controllers\Api\Locations\IndexController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});
