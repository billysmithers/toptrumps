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
            ->expectsOutput('Site built.');

        Storage::exists('css/app.css');
        Storage::exists('js/app.js');

        foreach (Config::get('games') as $theme => $game) {
            foreach ($game as $gameKey => $params) {
                Storage::exists($theme . DIRECTORY_SEPARATOR . $gameKey . DIRECTORY_SEPARATOR . 'index.html');
            }
        }
    }
}
