<?php

namespace Tests\Feature;

use Tests\TestCase;

class StarshipsTest extends TestCase
{
    public function testStarships()
    {
        $response = $this->get(route('star-wars.starships'));

        $response->assertStatus(200);

        $response->assertSeeText('Death Star');
    }
}
