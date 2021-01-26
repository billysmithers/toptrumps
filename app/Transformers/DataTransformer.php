<?php

namespace App\Transformers;

use App\Models\Card;

interface DataTransformer
{
    /**
     * @param array $data
     * @return Card
     */
    public static function transformForCard(array $data): Card;
}
