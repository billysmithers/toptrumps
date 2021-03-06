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
                'engine_size_(cc)' => 2000,
                'wheels'           => 4,
            ],
            'https://cdn.example.com/image.jpg'
        );

        $this->assertEquals(
            json_encode(
                [
                    'name'         => 'Ford Mustang',
                    'capabilities' => [
                        [
                            'capability' => 'engine size (cc)',
                            'value'      => 2000,
                        ],
                        [
                            'capability' => 'wheels',
                            'value'      => 4,
                        ],
                        [
                            'capability' => 'year',
                            'value'      => 1972,
                        ],
                    ],
                    'imageUrl'      => 'https://cdn.example.com/image.jpg',
                ]
            ),
            json_encode($card)
        );
    }
}
