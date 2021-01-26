<?php

namespace Tests\Unit;


use App\Api\StarWars\StarshipsDataTransformer;
use App\Models\Card;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class StarShipsDataTransformerTest extends TestCase
{
    public function testCanTransformStarshipData(): void
    {
        $card = new Card(
            'Death Star',
            [
                'cost_in_credits'     => 1000000000000,
                'length'              => 120000,
                'cargo_capacity'      => 1000000000000,
                'hyperdrive_rating'   => 4.0,
                'MGLT'                => 10,
                'consumables (years)' => 3,
                'crew'                => 342953,
                'passengers'          => 843342,
            ]
        );

        $this->assertEquals(
            json_encode($card),
            json_encode(
                StarshipsDataTransformer::transformForCard(
                    [
                        'name'                   => 'Death Star',
                        'model'                  => 'DS-1 Orbital Battle Station',
                        'cost_in_credits'        => '1000000000000',
                        'length'                 => '120000',
                        'max_atmosphering_speed' => 'n/a',
                        'crew'                   => '342,953',
                        'passengers'             => '843,342',
                        'cargo_capacity'         => '1000000000000',
                        'consumables'            => '3 years',
                        'hyperdrive_rating'      => '4.0',
                        'MGLT'                   => '10',
                    ]
                )
            )
        );
    }

    public function testThrowsExceptionIfNoName()
    {
        $this->expectException(InvalidArgumentException::class);

        StarshipsDataTransformer::transformForCard(
            [
                'model'                  => 'DS-1 Orbital Battle Station',
                'cost_in_credits'        => '1000000000000',
                'length'                 => '120000',
                'max_atmosphering_speed' => 'n/a',
                'crew'                   => '342,953',
                'passengers'             => '843,342',
                'cargo_capacity'         => '1000000000000',
                'consumables'            => '3 years',
                'hyperdrive_rating'      => '4.0',
                'MGLT'                   => '10',
            ]
        );
    }
}
