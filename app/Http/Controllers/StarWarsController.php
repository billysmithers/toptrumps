<?php

namespace App\Http\Controllers;

use App\Api\StarWars\StarshipFetcher;
use App\Transformers\StarWars\StarshipsDataTransformer;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;

class StarWarsController extends BaseController
{
    public function starships(StarshipFetcher $fetcher)
    {
        $cards     = [];
        $starships = $fetcher->fetch();

        foreach($starships as $starship) {
            $cards[] = StarshipsDataTransformer::transformForCard($starship);
        }

        return View::make(
            'cards',
            [
                'game'  => 'Star Wars Starships',
                'cards' => json_decode(json_encode($cards)),
            ]
        );
    }
}
