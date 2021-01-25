<?php

namespace App\Api;

use App\Models\Card;

interface DataTransformer
{
    /**
     * @return Card[]
     */
    public function transformForCard(): array;
}
