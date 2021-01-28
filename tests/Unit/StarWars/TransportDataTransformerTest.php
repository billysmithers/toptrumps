<?php

namespace Tests\Unit\StarWars;

use App\Models\Card;
use App\Transformers\StarWars\TransportDataTransformer;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class TransportDataTransformerTest extends TestCase
{
    public function testCanTransformStarshipData(): void
    {
        $card = new Card(
            'Death Star',
            [
                'cost_in_credits'    => 1000000000000,
                'length'             => 120000,
                'cargo_capacity'     => 1000000000000,
                'hyperdrive_rating'  => 4.0,
                'MGLT'               => 10,
                'consumables (days)' => 1095,
                'crew'               => 342953,
                'passengers'         => 843342,
            ]
        );

        $this->assertEquals(
            json_encode($card),
            json_encode(
                TransportDataTransformer::transformForCard(
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

    public function testCanTransformVehicleData(): void
    {
        $card = new Card(
            'Sand Crawler',
            [
                'cargo_capacity'         => 50000,
                'cost_in_credits'        => 150000,
                'crew'                   => 46,
                'length'                 => 36.8,
                'max_atmosphering_speed' => 30,
                'passengers'             => 30,
                'consumables (days)'     => 56,
            ]
        );

        $this->assertEquals(
            json_encode($card),
            json_encode(
                TransportDataTransformer::transformForCard(
                    [
                        'cargo_capacity'         => '50000',
                        'consumables'            => '2 months',
                        'cost_in_credits'        => '150000',
                        'crew'                   => '46',
                        'length'                 => '36.8',
                        'manufacturer'           => 'Corellia Mining Corporation',
                        'max_atmosphering_speed' => '30',
                        'model'                  => 'Digger Crawler',
                        'name'                   => 'Sand Crawler',
                        'passengers'             => '30',
                   ]
                )
            )
        );
    }

    public function testIgnoresUnapplicableConsumables(): void
    {
        $card = new Card(
            'Death Star',
            [
                'cost_in_credits'     => 1000000000000,
                'length'              => 120000,
                'cargo_capacity'      => 1000000000000,
                'hyperdrive_rating'   => 4.0,
                'MGLT'                => 10,
                'crew'                => 342953,
                'passengers'          => 843342,
            ]
        );

        $this->assertEquals(
            json_encode($card),
            json_encode(
                TransportDataTransformer::transformForCard(
                    [
                        'name'                   => 'Death Star',
                        'model'                  => 'DS-1 Orbital Battle Station',
                        'cost_in_credits'        => '1000000000000',
                        'length'                 => '120000',
                        'max_atmosphering_speed' => 'n/a',
                        'crew'                   => '342,953',
                        'passengers'             => '843,342',
                        'cargo_capacity'         => '1000000000000',
                        'consumables'            => 'unknown',
                        'hyperdrive_rating'      => '4.0',
                        'MGLT'                   => '10',
                    ]
                )
            )
        );

        $this->assertEquals(
            json_encode($card),
            json_encode(
                TransportDataTransformer::transformForCard(
                    [
                        'name'                   => 'Death Star',
                        'model'                  => 'DS-1 Orbital Battle Station',
                        'cost_in_credits'        => '1000000000000',
                        'length'                 => '120000',
                        'max_atmosphering_speed' => 'n/a',
                        'crew'                   => '342,953',
                        'passengers'             => '843,342',
                        'cargo_capacity'         => '1000000000000',
                        'consumables'            => 'none',
                        'hyperdrive_rating'      => '4.0',
                        'MGLT'                   => '10',
                    ]
                )
            )
        );
    }

    public function testFormatsConsumables(): void
    {
        $card = new Card(
            'Death Star',
            [
                'cost_in_credits'     => 1000000000000,
                'length'              => 120000,
                'cargo_capacity'      => 1000000000000,
                'hyperdrive_rating'   => 4.0,
                'MGLT'                => 10,
                'consumables (days)'  => 2,
                'crew'                => 342953,
                'passengers'          => 843342,
            ]
        );

        $this->assertEquals(
            json_encode($card),
            json_encode(
                TransportDataTransformer::transformForCard(
                    [
                        'name'                   => 'Death Star',
                        'model'                  => 'DS-1 Orbital Battle Station',
                        'cost_in_credits'        => '1000000000000',
                        'length'                 => '120000',
                        'max_atmosphering_speed' => 'n/a',
                        'crew'                   => '342,953',
                        'passengers'             => '843,342',
                        'cargo_capacity'         => '1000000000000',
                        'consumables'            => '2 days',
                        'hyperdrive_rating'      => '4.0',
                        'MGLT'                   => '10',
                    ]
                )
            )
        );

        $card = new Card(
            'Death Star',
            [
                'cost_in_credits'     => 1000000000000,
                'length'              => 120000,
                'cargo_capacity'      => 1000000000000,
                'hyperdrive_rating'   => 4.0,
                'MGLT'                => 10,
                'consumables (days)'  => 7,
                'crew'                => 342953,
                'passengers'          => 843342,
            ]
        );

        $this->assertEquals(
            json_encode($card),
            json_encode(
                TransportDataTransformer::transformForCard(
                    [
                        'name'                   => 'Death Star',
                        'model'                  => 'DS-1 Orbital Battle Station',
                        'cost_in_credits'        => '1000000000000',
                        'length'                 => '120000',
                        'max_atmosphering_speed' => 'n/a',
                        'crew'                   => '342,953',
                        'passengers'             => '843,342',
                        'cargo_capacity'         => '1000000000000',
                        'consumables'            => '1 week',
                        'hyperdrive_rating'      => '4.0',
                        'MGLT'                   => '10',
                    ]
                )
            )
        );

        $card = new Card(
            'Death Star',
            [
                'cost_in_credits'     => 1000000000000,
                'length'              => 120000,
                'cargo_capacity'      => 1000000000000,
                'hyperdrive_rating'   => 4.0,
                'MGLT'                => 10,
                'consumables (days)'  => 0,
                'crew'                => 342953,
                'passengers'          => 843342,
            ]
        );

        $this->assertEquals(
            json_encode($card),
            json_encode(
                TransportDataTransformer::transformForCard(
                    [
                        'name'                   => 'Death Star',
                        'model'                  => 'DS-1 Orbital Battle Station',
                        'cost_in_credits'        => '1000000000000',
                        'length'                 => '120000',
                        'max_atmosphering_speed' => 'n/a',
                        'crew'                   => '342,953',
                        'passengers'             => '843,342',
                        'cargo_capacity'         => '1000000000000',
                        'consumables'            => '0',
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

        TransportDataTransformer::transformForCard(
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
