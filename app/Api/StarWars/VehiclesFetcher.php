<?php

namespace App\Api\StarWars;

use App\Api\Fetcher;

class VehiclesFetcher extends TransportFetcher implements Fetcher
{
    public function fetch(): array
    {
        return $this->fetchByTransportType('vehicles/');
    }
}
