<?php

namespace App\Api\StarWars;

class StarshipsFetcher extends ResourceFetcher
{
    public function fetch(): array
    {
        return $this->fetchByResourceType(static::STARSHIPS);
    }
}
