<?php

namespace App\Api\Lego;

use App\Api\Fetcher;
use App\Constants\LogTypes;
use App\Traits\LogsApiException;
use GuzzleHttp\Exception\GuzzleException;
use http\Message;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use JsonException;

class SetsFetcher implements Fetcher
{
    use LogsApiException;

    private const PAGE_SIZE = 32;

    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function fetch(): array
    {
        try {
            $response = $this->client->get(
                'sets/',
                [
                    'query' => [
                        'key'       => Config::get('api.lego.key'),
                        'page_size' => self::PAGE_SIZE,
                    ]
                ]
            );

            $responseBody = json_decode(
                (string) $response->getBody(),
                true,
                512,
                JSON_THROW_ON_ERROR
            );

            return $responseBody['results'] ?? [];
        } catch (JsonException $e) {
            Log::error(
                'Failed to fetch Lego sets due to issues with the JSON response.',
                [
                    'logType'       => LogTypes::LEGO,
                    'responseBody'  => ! empty($response) ? (new Message)->toString($response) : null,
                    'exception'     => $this->formatExceptionForLogging($e),
                ]
            );

            return [];
        } catch (GuzzleException $e) {
            Log::error(
                'Failed to fetch Lego sets due to issues with the API call.',
                [
                    'logType'       => LogTypes::LEGO,
                    'exception'     => $this->formatExceptionForLogging($e),
                ]
            );

            return [];
        }
    }
}
