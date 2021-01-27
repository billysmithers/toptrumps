<?php

namespace Tests\Feature\Api\StarWars;

use App\Api\StarWars\StarshipFetcher;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Config;
use Tests\Shared\StarWars\MockClient as Client;
use Tests\TestCase;

class StarshipFetcherTest extends TestCase
{
    public function testFetchesStarships()
    {
        $client  = new Client([
            new Response(
                200,
                [],
                json_encode(
                    [
                        'next'    => Config::get('api.starwars.base_uri') . 'starships/?page=2',
                        'results' => [
                            [
                                'name' => 'Death Star'
                            ],
                        ],
                    ]
                )
            ),
            new Response(
                200,
                [],
                json_encode(
                    [
                        'results' => [
                            [
                                'name' => 'Millenium Falcon'
                            ],
                        ],
                    ]
                )
            ),
        ]);

        $fetcher = new StarshipFetcher($client);

        $this->assertEquals(
            [
                [
                    'name' => 'Death Star'
                ],
                [
                    'name' => 'Millenium Falcon'
                ]
            ],
            $fetcher->fetch()
        );
    }
}
