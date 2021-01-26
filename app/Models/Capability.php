<?php

declare(strict_types=1);

namespace App\Models;

use JsonSerializable;

class Capability implements JsonSerializable
{
    private string $key;

    private int|float $value;

    public function __construct(string $key, int|float $value)
    {
        $this->key   = $key;
        $this->value = $value;
    }

    public function jsonSerialize(): array
    {
        return [
            'key'   => $this->key,
            'value' => $this->value,
        ];
    }
}
