<?php

namespace Tests\Unit;

use App\Models\Card;
use PHPUnit\Framework\TestCase;

class CardTest extends TestCase
{
    public function testCanCreateACardAndTurnToJson(): void
    {
        $card = new Card(
            'Ford Mustang',
            [
                'year'             => 1972,
                'engine-size (cc)' => 2000,
                'wheels'           => 4,
            ]
        );

        $this->assertEquals(
            json_encode(
                [
                    'name'         => 'Ford Mustang',
                    'capabilities' => [
                        [
                            'key'   => 'year',
                            'value' => 1972,
                        ],
                        [
                            'key'   => 'engine-size (cc)',
                            'value' => 2000,
                        ],
                        [
                            'key'   => 'wheels',
                            'value' => 4,
                        ],
                    ]
                ]
            ),
            json_encode($card)
        );
    }
}
