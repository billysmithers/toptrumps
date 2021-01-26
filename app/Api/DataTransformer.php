<?php

namespace App\Api;

use App\Models\Card;

interface DataTransformer
{
    /**
     * @param array $apiResponse
     * @return Card
     */
    public static function transformForCard(array $apiResponse): Card;
}
