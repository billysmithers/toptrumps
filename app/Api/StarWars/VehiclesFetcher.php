<?php

namespace App\Api\StarWars;

class VehiclesFetcher extends ResourceFetcher
{
    public function fetch(): array
    {
        return $this->fetchByResourceType(static::VEHICLES);
    }
}
