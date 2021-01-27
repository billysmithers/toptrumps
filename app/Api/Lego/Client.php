<?php

namespace App\Api\Lego;

use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Config;

class Client extends GuzzleClient
{
    public function __construct(array $config = [])
    {
        parent::__construct(array_merge([
            'base_uri' => Config::get('api.lego.base_uri'),
        ], $config));
    }
}
