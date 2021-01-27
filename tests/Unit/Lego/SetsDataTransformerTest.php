<?php

namespace Tests\Unit\Lego;

use App\Models\Card;
use App\Transformers\Lego\SetsDataTransformer;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class SetsDataTransformerTest extends TestCase
{
    public function testCanTransformSetData(): void
    {
        $card = new Card(
            'Town Mini-Figures',
            [
                'year'      => 1978,
                'num_parts' => 12,
                'set_num'   => 11,
            ],
            'https://cdn.rebrickable.com/media/sets/0011-2/3318.jpg'
        );

        $this->assertEquals(
            json_encode($card),
            json_encode(
                SetsDataTransformer::transformForCard(
                    [
                        'set_num'          => '0011-2',
                        'name'             => 'Town Mini-Figures',
                        'year'             => 1978,
                        'theme_id'         => 84,
                        'num_parts'        => 12,
                        'set_img_url'      => 'https://cdn.rebrickable.com/media/sets/0011-2/3318.jpg',
                        'set_url'          => 'https://rebrickable.com/sets/0011-2/town-mini-figures/',
                        'last_modified_dt' => '2013-12-08T15:42:23.174688Z',
                    ]
                )
            )
        );
    }

    public function testThrowsExceptionIfNoName()
    {
        $this->expectException(InvalidArgumentException::class);

        SetsDataTransformer::transformForCard(
            [
                'set_num'          => '0011-2',
                'year'             => 1978,
                'theme_id'         => 84,
                'num_parts'        => 12,
                'set_img_url'      => 'https://cdn.rebrickable.com/media/sets/0011-2/3318.jpg',
                'set_url'          => 'https://rebrickable.com/sets/0011-2/town-mini-figures/',
                'last_modified_dt' => '2013-12-08T15:42:23.174688Z',
            ]
        );
    }
}
