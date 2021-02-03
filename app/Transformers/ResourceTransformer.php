<?php

namespace App\Transformers;

use App\Models\Card;

interface ResourceTransformer
{
    /**
     * @param array $resource
     * @return Card
     */
    public static function transformForCard(array $resource): Card;
}
