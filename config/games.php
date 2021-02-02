<?php

use App\Api\Lego\SetsFetcher;
use App\Api\StarWars\StarshipsFetcher;
use App\Api\StarWars\VehiclesFetcher;
use App\Transformers\Lego\SetsDataTransformer;
use App\Transformers\StarWars\TransportDataTransformer;

return [
    'starwars' => [
        'name' => 'Star Wars',
        'games' => [
            'starships' => [
                'name'        => 'Star Wars Starships',
                'fetcher'     => StarshipsFetcher::class,
                'transformer' => TransportDataTransformer::class,
                'credits'     => 'Data supplied by https://swapi.dev',
            ],
            'vehicles' => [
                'name'        => 'Star Wars Vehicles',
                'fetcher'     => VehiclesFetcher::class,
                'transformer' => TransportDataTransformer::class,
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
                'transformer' => SetsDataTransformer::class,
                'credits'     => 'Data supplied by https://rebrickable.com',
            ],
        ],
    ],
];
