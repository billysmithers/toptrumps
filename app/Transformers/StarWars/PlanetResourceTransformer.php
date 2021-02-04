<?php

declare(strict_types=1);

namespace App\Transformers\StarWars;

use App\Transformers\ResourceTransformer;
use App\Models\Card;
use InvalidArgumentException;

class PlanetResourceTransformer implements ResourceTransformer
{
    /**
     * Based on the API response from https://swapi.dev/api/planets/4/
     * {
        "name": "Hoth",
        "rotation_period": "23",
        "orbital_period": "549",
        "diameter": "7200",
        "climate": "frozen",
        "gravity": "1.1 standard",
        "terrain": "tundra, ice caves, mountain ranges",
        "surface_water": "100",
        "population": "unknown",
        "residents": [],
        "films": [
        "http://swapi.dev/api/films/2/"
        ],
        "created": "2014-12-10T11:39:13.934000Z",
        "edited": "2014-12-20T20:58:18.423000Z",
        "url": "http://swapi.dev/api/planets/4/"
        }
     * @param array $resource
     * @return Card
     */
    public static function forCard(array $resource): Card
    {
        $capabilities = [];

        if (empty($resource['name'])) {
            throw new InvalidArgumentException('A card must have a name.');
        }

        foreach ($resource as $key => $value) {
            if ($key === 'name') {
                continue;
            }

            if (is_numeric($value)) {
                $capabilities[$key] = (float) $value;
            }
        }

        return new Card($resource['name'], $capabilities);
    }
}
