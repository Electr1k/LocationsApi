<?php

namespace App\Http\Controllers\Api\Locations;

use App\Http\Resources\LocationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TrashedController extends LocationsController
{
    public function __invoke(Request $request): AnonymousResourceCollection
    {
        return LocationResource::collection($this->service->trashed());
    }
}
