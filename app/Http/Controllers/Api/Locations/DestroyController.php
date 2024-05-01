<?php

namespace App\Http\Controllers\Api\Locations;

use App\Http\Resources\LocationResource;
use App\Models\Location;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DestroyController extends LocationsController
{
    public function __invoke(Location $location): bool|JsonResponse
    {
        return $this->service->destroy($location);
    }
}
