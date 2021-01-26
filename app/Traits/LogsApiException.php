<?php

declare(strict_types=1);

namespace App\Traits;

use Exception;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;

trait LogsApiException
{
    private function formatExceptionForLogging(Exception $e): array
    {
        $formatted = [
            'message' => $e->getMessage(),
            'trace'   => $e->getTraceAsString(),
            'type'    => get_class($e),
        ];

        if ($e instanceof RequestException) {
            $formatted['request']  = Psr7\str($e->getRequest());
            $formatted['response'] = $e->hasResponse() ? Psr7\str($e->getResponse()) : null;
        }

        return $formatted;
    }
}
