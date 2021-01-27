<?php

return [
    'starwars' => [
        'name' => 'Star Wars',
        'games' => [
            'starships' => [
                'name'        => 'Star Wars Starships',
                'fetcher'     => \App\Api\StarWars\StarshipFetcher::class,
                'transformer' => \App\Transformers\StarWars\StarshipsDataTransformer::class,
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
