<?php

namespace Tests\Unit;

use App\Models\Capability;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class CapabilityTest extends TestCase
{
    public function testCanCreateACapabilityAndTurnToJson(): void
    {
        $capability = new Capability('year', 1972);

        $this->assertEquals(
            json_encode(
                [
                    'capability' => 'year',
                    'value'      => 1972,
                ]
            ),
            json_encode($capability)
        );

        $capability = new Capability('weight (kg)', 1000.97);

        $this->assertEquals(
            json_encode(
                [
                    'capability' => 'weight (kg)',
                    'value'      => 1000.97,
                ]
            ),
            json_encode($capability)
        );
    }

    public function testThrowsErrorOnInvalidData(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Capability('year', '900 AD');
    }
}
