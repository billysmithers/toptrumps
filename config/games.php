<?php

return [
    'starwars' => [
        'starships' => [
            'name'        => 'Star Wars Starships',
            'fetcher'     => \App\Api\StarWars\StarshipFetcher::class,
            'transformer' => \App\Transformers\StarWars\StarshipsDataTransformer::class,
        ],
    ],
];
