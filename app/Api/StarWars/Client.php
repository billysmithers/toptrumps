<?php

namespace App\Api\StarWars;

use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Config;

class Client extends GuzzleClient
{
    public function __construct(array $config = [])
    {
        parent::__construct(array_merge([
            'base_uri' => Config::get('api.starwars.base_uri'),
        ], $config));
    }
}
