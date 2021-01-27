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
        $this->info('Building static site...');

        $games = Config::get('games');

        $this->buildWelcome($games);

        $this->buildGames($games);

        $this->copyPublic();

        $this->info('Static site built.');
    }

    private function buildWelcome(array $games): void
    {
        Storage::put(
            'index.html',
            View::make(
                'welcome',
                ['games' => $games]
            )
        );
    }

    private function buildGames(array $games): void
    {
        foreach ($games as $themeKey => $themeParams) {
            foreach ($themeParams['games'] as $gameKey => $gameParams) {
                $fetcher = App::make($gameParams['fetcher']);
                $cards   = [];
                $data    = $fetcher->fetch();

                foreach ($data as $datum) {
                    $cards[] = $gameParams['transformer']::transformForCard($datum);
                }

                $path = $themeKey . DIRECTORY_SEPARATOR . $gameKey;

                Storage::put(
                    $path . DIRECTORY_SEPARATOR . 'index.html',
                    View::make(
                        'cards',
                        [
                            'game'    => $gameParams['name'],
                            'cards'   => json_decode(json_encode($cards)),
                            'credits' => $gameParams['credits'],
                        ]
                    )
                );
            }
        }
    }

    private function copyPublic()
    {
        $blacklist = [
            '.htaccess',
            'index.php',
        ];

        $files = Storage::disk('app-public')->allFiles();

        foreach ($files as $filePath) {
            if (in_array($filePath, $blacklist)) {
                continue;
            }

            $file = Storage::disk('app-public')->get($filePath);

            Storage::put($filePath, $file);
        }
    }
}
