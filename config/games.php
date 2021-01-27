<?php

return [
    'starwars' => [
        'name' => 'Star Wars',
        'games' => [
            'starships' => [
                'name'             => 'Star Wars Starships',
                'backgroundColour' => 'black',
                'fetcher'          => \App\Api\StarWars\StarshipFetcher::class,
                'transformer'      => \App\Transformers\StarWars\StarshipsDataTransformer::class,
                'credits'          => 'Data supplied by https://swapi.dev/',
            ],
        ],
    ],
];
