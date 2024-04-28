<?php

namespace App\Services;

use App\Models\Location;

class LocationsService
{
    public function store(Location $location): void
    {
        Location::create($location);
    }
}
