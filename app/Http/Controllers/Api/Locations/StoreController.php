<?php

namespace App\Http\Controllers\Api\Locations;

use App\Http\Requests\Locations\StoreRequest;
use App\Http\Resources\LocationResource;

class StoreController extends LocationsController
{
    public function __invoke(StoreRequest $request): LocationResource
    {
        $data = $request->validated();
        $location = $this->service->store($data);
        return new LocationResource($location);
    }
}
