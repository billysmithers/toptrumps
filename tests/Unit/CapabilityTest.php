<?php

namespace Tests\Unit;

use App\Models\Capability;
use PHPUnit\Framework\TestCase;
use TypeError;

class CapabilityTest extends TestCase
{
    public function testCanCreateACapabilityAndTurnToJson(): void
    {
        $capability = new Capability('year', 1972);

        $this->assertEquals(
            json_encode(
                [
                    'key'   => 'year',
                    'value' => 1972,
                ]
            ),
            json_encode($capability)
        );

        $capability = new Capability('weight (kg)', 1000.97);

        $this->assertEquals(
            json_encode(
                [
                    'key'   => 'weight (kg)',
                    'value' => 1000.97,
                ]
            ),
            json_encode($capability)
        );
    }

    public function testThrowsErrorOnInvalidData(): void
    {
        $this->expectException(TypeError::class);
        new Capability('year', '900 AD');
    }
}
