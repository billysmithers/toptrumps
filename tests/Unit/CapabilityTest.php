<?php

namespace Tests\Unit;

use App\Models\Capability;
use PHPUnit\Framework\TestCase;

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
    }
}
