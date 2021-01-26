<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class BuildStaticSiteCommand extends Command
{
    protected $signature = 'static-site:build';

    protected $description = 'Build a static site';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        foreach (Config::get('games') as $theme => $game) {
            foreach ($game as $gameKey => $params) {
                $fetcher = App::make($params['fetcher']);
                $cards   = [];
                $data    = $fetcher->fetch();

                foreach($data as $datum) {
                    $cards[] = $params['transformer']::transformForCard($datum);
                }

                $path = $theme . DIRECTORY_SEPARATOR . $gameKey;

                Storage::put(
                    $path . DIRECTORY_SEPARATOR . 'index.html',
                    View::make(
                    'cards',
                        [
                            'game'  => $params['name'],
                            'cards' => json_decode(json_encode($cards)),
                        ]
                    )
                );
            }
        }

        $this->info('Site built.');
    }
}
