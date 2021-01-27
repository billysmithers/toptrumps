<?php

namespace Tests\Feature\Console\Commands;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BuildStaticSiteCommandTest extends TestCase
{
    public function testCanBuildStaticSite(): void
    {
        Storage::fake();

        $this->artisan('static-site:build')
            ->expectsOutput('Building static site...')
            ->expectsOutput('Static site built.');

        Storage::exists('css/app.css');
        Storage::exists('js/app.js');

        foreach (Config::get('games') as $themeKey => $themeParams) {
            foreach ($themeParams['games'] as $gameKey => $gameParams) {
                Storage::exists($themeKey . DIRECTORY_SEPARATOR . $gameKey . DIRECTORY_SEPARATOR . 'index.html');
            }
        }
    }
}
