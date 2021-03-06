<?php

declare(strict_types=1);

namespace App\Models;

use InvalidArgumentException;
use JsonSerializable;

class Capability implements JsonSerializable
{
    private string $capability;

    /**
     * @var int|float
     */
    private $value;

    public function __construct(string $capability, $value)
    {
        if (! is_numeric($value)) {
            throw new InvalidArgumentException('A capability value must be numeric.');
        }

        $this->capability = $capability;
        $this->value      = $value;
    }

    public function getCapability(): string
    {
        return $this->capability;
    }

    public function jsonSerialize(): array
    {
        return [
            'capability' => str_replace(['_', '-'], ' ', $this->capability),
            'value'      => $this->value,
        ];
    }
}
