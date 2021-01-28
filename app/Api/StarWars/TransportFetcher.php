<?php

namespace App\Api\StarWars;

use App\Api\Fetcher;
use App\Constants\LogTypes;
use App\Traits\LogsApiException;
use GuzzleHttp\Exception\GuzzleException;
use http\Message;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;
use JsonException;

class TransportFetcher
{
    use LogsApiException;

    private const NUMBER_OF_RESOURCES = 32;

    private const VALID_RESOURCES = [
        'starships/',
        'vehicles/',
    ];

    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    protected function fetchByTransportType(string $type): array
    {
        if (! in_array($type, self::VALID_RESOURCES)) {
            throw new InvalidArgumentException(
                'Type of transport must be one of the following '
                . implode(' ', self::VALID_RESOURCES)
            );
        }

        $resources = [];
        $page      = $this->fetchPage($type);

        if (empty($page['results'])) {
            return [];
        }

        do {
            foreach ($page['results'] ?? [] as $starship) {
                $resources[] = $starship;
            }

            if (! empty($page['next'])) {
                $page = $this->fetchPage($type, $page['next']);
            } else {
                $page['results'] = [];
            }
        } while (! empty($page['results']));

        return array_slice($resources, 0, self::NUMBER_OF_RESOURCES);
    }

    private function fetchPage(string $type, string $nextUrl = null): array
    {
        try {
            if ($nextUrl) {
                $response = $this->client->get($nextUrl);
            } else {
                $response = $this->client->get($type);
            }

            return json_decode((string) $response->getBody(), true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            Log::error(
                "Failed to fetch Star Wars {{$type}} due to issues with the JSON response.",
                [
                    'logType'       => LogTypes::STAR_WARS,
                    'responseBody'  => ! empty($response) ? (new Message)->toString($response) : null,
                    'exception'     => $this->formatExceptionForLogging($e),
                ]
            );

            return [];
        } catch (GuzzleException $e) {
            Log::error(
                "Failed to fetch Star Wars {{$type}} due to issues with the API call.",
                [
                    'logType'       => LogTypes::STAR_WARS,
                    'exception'     => $this->formatExceptionForLogging($e),
                ]
            );

            return [];
        }
    }
}
