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

    public function jsonSerialize(): array
    {
        return [
            'capability' => $this->capability,
            'value'      => $this->value,
        ];
    }
}
