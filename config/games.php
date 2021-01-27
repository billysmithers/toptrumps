<?php

return [
    'starwars' => [
        'name' => 'Star Wars',
        'games' => [
            'starships' => [
                'name'        => 'Star Wars Starships',
                'fetcher'     => \App\Api\StarWars\StarshipFetcher::class,
                'transformer' => \App\Transformers\StarWars\StarshipsDataTransformer::class,
            ],
        ],
    ],
];
