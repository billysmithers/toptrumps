<?php

declare(strict_types=1);

namespace App\Transformers\StarWars;

use App\Transformers\ResourceTransformer;
use App\Models\Card;
use InvalidArgumentException;

class TransportResourceTransformer implements ResourceTransformer
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
     * and https://swapi.dev/api/vehicles/4/
     * {
            * "cargo_capacity": "50000",
            * "consumables": "2 months",
            * "cost_in_credits": "150000",
            * "created": "2014-12-10T15:36:25.724000Z",
            * "crew": "46",
            * "edited": "2014-12-10T15:36:25.724000Z",
            * "length": "36.8",
            * "manufacturer": "Corellia Mining Corporation",
            * "max_atmosphering_speed": "30",
            * "model": "Digger Crawler",
            * "name": "Sand Crawler",
            * "passengers": "30",
            * "pilots": [],
            * "films": [
            * "https://swapi.dev/api/films/1/"
            * ],
            * "url": "https://swapi.dev/api/vehicles/4/",
     * "vehicle_class": "wheeled"
     * }
     * @param array $resource
     * @return Card
     */
    public static function transformForCard(array $resource): Card
    {
        $capabilities = [];

        if (empty($resource['name'])) {
            throw new InvalidArgumentException('A card must have a name.');
        }

        foreach ($resource as $key => $value) {
            if (in_array($key, ['name', 'consumables'])) {
                continue;
            }

            if (is_numeric($value)) {
                $capabilities[$key] = (float) $value;
            }
        }

        $consumables = self::formatConsumables($resource['consumables']);

        if ($consumables) {
             $capabilities = array_merge($capabilities, $consumables);
        }

        if (! empty($resource['crew'])) {
            $capabilities['crew'] = (int)str_replace(',', '', $resource['crew']);
        }

        if (! empty($resource['passengers'])) {
            $capabilities['passengers'] = (int) str_replace(',', '', $resource['passengers']);
        }

        return new Card($resource['name'], $capabilities);
    }

    private static function formatConsumables(?string $consumables): array
    {
        if (is_null($consumables) || in_array($consumables, ['unknown', 'none'])) {
            return [];
        }

        $parts         = explode(' ', $consumables);
        $value         = $parts[0];
        $unitOfMeasure = $parts[1] ?? null;

        switch ($unitOfMeasure) {
            case 'week':
            case 'weeks':
                $valueAsDays = $value * 7;

                break;
            case 'month':
            case 'months':
                $valueAsDays = $value * 28;

                break;
            case 'year':
            case 'years':
                $valueAsDays = $value * 365;

                break;
            default:
                $valueAsDays = $value;
        }

        return [
            'consumables (days)' => (int) $valueAsDays,
        ];
    }
}
