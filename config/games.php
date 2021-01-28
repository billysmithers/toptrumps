<?php

return [
    'starwars' => [
        'name' => 'Star Wars',
        'games' => [
            'starships' => [
                'name'        => 'Star Wars Starships',
                'fetcher'     => \App\Api\StarWars\StarshipsFetcher::class,
                'transformer' => \App\Transformers\StarWars\TransportDataTransformer::class,
                'credits'     => 'Data supplied by https://swapi.dev',
            ],
            'vehicles' => [
                'name'        => 'Star Wars Vehicles',
                'fetcher'     => \App\Api\StarWars\VehiclesFetcher::class,
                'transformer' => \App\Transformers\StarWars\TransportDataTransformer::class,
                'credits'     => 'Data supplied by https://swapi.dev',
            ],
        ],
    ],
    'lego' => [
        'name' => 'Lego',
        'games' => [
            'sets' => [
                'name'        => 'Lego sets',
                'fetcher'     => \App\Api\Lego\SetsFetcher::class,
                'transformer' => \App\Transformers\Lego\SetsDataTransformer::class,
                'credits'     => 'Data supplied by https://rebrickable.com',
            ],
        ],
    ],
];
