<?php

namespace Tests\Feature\Api\Lego;

use App\Api\Lego\SetsFetcher;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Config;
use Tests\Shared\Lego\MockClient as Client;
use Tests\TestCase;

class SetsFetcherTest extends TestCase
{
    public function testFetchesSets()
    {
        $client  = new Client([
            new Response(
                200,
                [],
                json_encode(
                    [
                        'results' => [
                            [
                                'name' => 'Basic set'
                            ],
                            [
                                'name' => 'Classic Castle'
                            ]
                        ],
                    ]
                )
            ),
        ]);

        $fetcher = new SetsFetcher($client);

        $this->assertEquals(
            [
                [
                    'name' => 'Basic set'
                ],
                [
                    'name' => 'Classic Castle'
                ]
            ],
            $fetcher->fetch()
        );
    }
}
