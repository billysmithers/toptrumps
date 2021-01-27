<?php

declare(strict_types=1);

namespace App\Transformers\Lego;

use App\Transformers\DataTransformer;
use App\Models\Card;
use InvalidArgumentException;

class SetsDataTransformer implements DataTransformer
{
    /**
     * Based on the API response from https://rebrickable.com/api/v3/lego/sets/0011-2/
     * {
        "set_num": "0011-2",
        "name": "Town Mini-Figures",
        "year": 1978,
        "theme_id": 84,
        "num_parts": 12,
        "set_img_url": "https://cdn.rebrickable.com/media/sets/0011-2/3318.jpg",
        "set_url": "https://rebrickable.com/sets/0011-2/town-mini-figures/",
        "last_modified_dt": "2013-12-08T15:42:23.174688Z"
      }
     * @param array $data
     * @return Card
     */
    public static function transformForCard(array $data): Card
    {
        $capabilities = [];

        if (empty($data['name'])) {
            throw new InvalidArgumentException('A card must have a name.');
        }

        foreach ($data as $key => $value) {
            if ($key === 'name') {
                continue;
            }

            if (is_numeric($value)) {
                $capabilities[$key] = (float) $value;
            }
        }

        $capabilities['set_num'] = (int) explode('-', $data['set_num'])[0];

        unset($capabilities['theme_id']);

        return new Card($data['name'], $capabilities, $data['set_img_url']);
    }
}
