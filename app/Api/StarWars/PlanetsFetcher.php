<?php

namespace App\Api\StarWars;

class PlanetsFetcher extends ResourceFetcher
{
    public function fetch(): array
    {
        return $this->fetchByResourceType(static::PLANETS);
    }
}
