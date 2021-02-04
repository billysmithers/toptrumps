<?php

use App\Api\Lego\SetsFetcher;
use App\Api\StarWars\PlanetsFetcher;
use App\Api\StarWars\StarshipsFetcher;
use App\Api\StarWars\VehiclesFetcher;
use App\Transformers\Lego\SetResourceTransformer;
use App\Transformers\StarWars\PlanetResourceTransformer;
use App\Transformers\StarWars\TransportResourceTransformer;

return [
    'starwars' => [
        'name' => 'Star Wars',
        'games' => [
            'planets' => [
                'name'        => 'Star Wars Planets',
                'fetcher'     => PlanetsFetcher::class,
                'transformer' => PlanetResourceTransformer::class,
                'credits'     => 'Data supplied by https://swapi.dev',
            ],
            'starships' => [
                'name'        => 'Star Wars Starships',
                'fetcher'     => StarshipsFetcher::class,
                'transformer' => TransportResourceTransformer::class,
                'credits'     => 'Data supplied by https://swapi.dev',
            ],
            'vehicles' => [
                'name'        => 'Star Wars Vehicles',
                'fetcher'     => VehiclesFetcher::class,
                'transformer' => TransportResourceTransformer::class,
                'credits'     => 'Data supplied by https://swapi.dev',
            ],
        ],
    ],
    'lego' => [
        'name' => 'Lego',
        'games' => [
            'sets' => [
                'name'        => 'Lego sets',
                'fetcher'     => SetsFetcher::class,
                'transformer' => SetResourceTransformer::class,
                'credits'     => 'Data supplied by https://rebrickable.com',
            ],
        ],
    ],
];
