<?php

namespace App\Http\Controllers\Api\Locations;

use App\Http\Controllers\Controller;
use App\Services\LocationsService;

class LocationsController extends Controller
{
    public LocationsService $service;

    public function __construct(LocationsService $service)
    {
        $this->service = $service;
    }
}
