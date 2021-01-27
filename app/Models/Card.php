<?php

declare(strict_types=1);

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

    private ?string $imageUrl;

    public function __construct(string $name, array $capabilitiesData, string $imageUrl = null)
    {
        $this->name         = $name;
        $this->imageUrl    = $imageUrl;
        $this->capabilities = new Collection();

        foreach ($capabilitiesData as $capabilityKey => $capabilityValue) {
            $this->addCapability(new Capability($capabilityKey, $capabilityValue));
        }
    }

    private function addCapability(Capability $capability): void
    {
        $this->capabilities->add($capability);
    }

    public function jsonSerialize(): array
    {
        return [
            'name'         => $this->name,
            'capabilities' => $this->capabilities,
            'imageUrl'     => $this->imageUrl,
        ];
    }
}
