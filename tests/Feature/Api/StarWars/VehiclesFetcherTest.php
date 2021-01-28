<?php

namespace Tests\Feature\Api\StarWars;

use App\Api\StarWars\VehiclesFetcher;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Config;
use Tests\Shared\StarWars\MockClient as Client;
use Tests\TestCase;

class VehiclesFetcherTest extends TestCase
{
    public function testFetchesStarships()
    {
        $client  = new Client([
            new Response(
                200,
                [],
                json_encode(
                    [
                        'next'    => Config::get('api.starwars.base_uri') . 'vehicles/?page=2',
                        'results' => [
                            [
                                'name' => 'Sand Crawler'
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
                                'name' => 'T-16 skyhopper'
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
                    'name' => 'Sand Crawler'
                ],
                [
                    'name' => 'T-16 skyhopper'
                ]
            ],
            $fetcher->fetch()
        );
    }
}
