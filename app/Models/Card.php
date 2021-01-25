<?php

namespace App\Models;

use Illuminate\Support\Collection;
use JsonSerializable;

class Card implements JsonSerializable
{
    private string $name;

    /**
     * @var Collection Capability[]
     */
    private Collection $capabilities;

    public function __construct(string $name, array $capabilitiesData)
    {
        $this->name = $name;

        foreach ($capabilitiesData as $capabilityKey => $capabilityValue) {
            $this->addCapability(new Capability());
        }
    }

    private function addCapability(Capability $capability): void
    {
        $this->capabilities->add($capability);
    }

    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
    }
}
