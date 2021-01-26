<?php

declare(strict_types=1);

namespace App\Transformers\StarWars;

use App\Transformers\DataTransformer;
use App\Models\Card;
use InvalidArgumentException;

class StarshipsDataTransformer implements DataTransformer
{
    /**
     * Based on the API response from https://swapi.dev/api/starships/9/
     * {
            * "name": "Death Star",
            * "model": "DS-1 Orbital Battle Station",
            * "manufacturer": "Imperial Department of Military Research, Sienar Fleet Systems",
            * "cost_in_credits": "1000000000000",
            * "length": "120000",
            * "max_atmosphering_speed": "n/a",
            * "crew": "342,953",
            * "passengers": "843,342",
            * "cargo_capacity": "1000000000000",
            * "consumables": "3 years",
            * "hyperdrive_rating": "4.0",
            * "MGLT": "10",
            * "starship_class": "Deep Space Mobile Battlestation",
            * "pilots": [],
            * "films": [
            * "http://swapi.dev/api/films/1/"
            * ],
            * "created": "2014-12-10T16:36:50.509000Z",
            * "edited": "2014-12-20T21:26:24.783000Z",
            * "url": "http://swapi.dev/api/starships/9/"
     * }
     * @param array $data
     * @return Card
     */
    public static function transformForCard(array $data): Card
    {
        $capabilities = [];

        if (empty($data['name'])) {
            throw new InvalidArgumentException('A card must have a name.');
        }

        foreach ($data as $key => $value) {
            if ($key === 'name') {
                continue;
            }

            if (is_numeric($value)) {
                $capabilities[$key] = (float) $value;
            }
        }

        if (! empty($data['consumables'])) {
            $capabilities['consumables (years)'] = (int) str_replace(
                ' years',
                '',
                $data['consumables']
            );
        }

        if (! empty($data['crew'])) {
            $capabilities['crew'] = (int) str_replace(',', '', $data['crew']);
        }

        if (! empty($data['passengers'])) {
            $capabilities['passengers'] = (int) str_replace(',', '', $data['passengers']);
        }

        return new Card($data['name'], $capabilities);
    }
}
