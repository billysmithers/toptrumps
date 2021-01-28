<?php

namespace App\Api\StarWars;

use App\Api\Fetcher;

class StarshipsFetcher extends TransportFetcher implements Fetcher
{
    public function fetch(): array
    {
        return $this->fetchByTransportType('starships/');
    }
}
