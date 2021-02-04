<?php

namespace Tests\Unit\StarWars;

use App\Models\Card;
use App\Transformers\StarWars\PlanetResourceTransformer;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class PlanetResourceTransformerTest extends TestCase
{
    public function testCanTransformPlanetData(): void
    {
        $card = new Card(
            'Hoth',
            [
                'rotation_period' => 23,
                'orbital_period'  => 549,
                'diameter'        => 7200,
                'surface_water'   => 100,
            ]
        );

        $this->assertEquals(
            json_encode($card),
            json_encode(
                PlanetResourceTransformer::forCard(
                    [
                        'name'            => 'Hoth',
                        'rotation_period' => '23',
                        'orbital_period'  => '549',
                        'diameter'        => '7200',
                        'climate'         => 'frozen',
                        'gravity'         => '1.1 standard',
                        'terrain'         => 'tundra, ice caves, mountain ranges',
                        'surface_water'   => '100',
                        'population'      => 'unknown',
                        'residents'       => [],
                    ]
                )
            )
        );
    }

    public function testThrowsExceptionIfNoName()
    {
        $this->expectException(InvalidArgumentException::class);

        PlanetResourceTransformer::forCard(
            [
                'rotation_period' => '23',
                'orbital_period'  => '549',
                'diameter'        => '7200',
                'climate'         => 'frozen',
                'gravity'         => '1.1 standard',
                'terrain'         => 'tundra, ice caves, mountain ranges',
                'surface_water'   => '100',
                'population'      => 'unknown',
                'residents'       => [],
            ]
        );
    }
}
