<?php

namespace App\Http\Controllers;

use App\Api\StarWars\Starship\Fetcher;
use App\Transformers\StarWars\StarshipsDataTransformer;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;

class StarWarsController extends BaseController
{
    public function starships(Fetcher $fetcher)
    {
        $cards     = [];
        $starships = $fetcher->fetchAll();

        foreach($starships as $starship) {
            $cards[] = StarshipsDataTransformer::transformForCard($starship);
        }

        return View::make('cards', ['cards' => json_decode(json_encode($cards))]);
    }
}
