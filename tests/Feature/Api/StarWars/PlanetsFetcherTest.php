<?php

namespace Tests\Feature\Api\StarWars;

use App\Api\StarWars\VehiclesFetcher;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Config;
use Tests\Shared\StarWars\MockClient as Client;
use Tests\TestCase;

class PlanetsFetcherTest extends TestCase
{
    public function testFetchesStarships()
    {
        $client  = new Client([
            new Response(
                200,
                [],
                json_encode(
                    [
                        'next'    => Config::get('api.starwars.base_uri') . 'planets/?page=2',
                        'results' => [
                            [
                                'name' => 'Hoth'
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
                                'name' => 'Yavin IV'
                            ],
                        ],
                    ]
                )
            ),
        ]);

        $fetcher = new VehiclesFetcher($client);

        $this->assertEquals(
            [
                [
                    'name' => 'Hoth'
                ],
                [
                    'name' => 'Yavin IV'
                ]
            ],
            $fetcher->fetch()
        );
    }
}
