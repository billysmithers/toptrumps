<?php

namespace App\Api\StarWars\Starship;

use App\Api\StarWars\Client;
use App\Constants\LogTypes;
use App\Traits\LogsApiException;
use GuzzleHttp\Exception\GuzzleException;
use http\Message;
use Illuminate\Support\Facades\Log;
use JsonException;

class Fetcher
{
    use LogsApiException;

    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function fetchAll(): array
    {
        $starships = [];
        $page      = $this->fetchPage();

        if (empty($page['results'])) {
            return [];
        }

        do {
            foreach ($page['results'] ?? [] as $starship) {
                $starships[] = $starship;
            }

            if (! empty($page['next'])) {
                $page = $this->fetchPage($page['next']);
            } else {
                $page['results'] = [];
            }
        } while (! empty($page['results']));

        return $starships;
    }

    public function fetchPage(string $nextUrl = null): array
    {
        try {
            if ($nextUrl) {
                $response = $this->client->get($nextUrl);
            } else {
                $response = $this->client->get('starships/');
            }

            return json_decode((string) $response->getBody(), true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            Log::error(
                'Failed to fetch Star Wars starships due to issues with the JSON response.',
                [
                    'logType'       => LogTypes::STAR_WARS,
                    'responseBody'  => ! empty($response) ? (new Message)->toString($response) : null,
                    'exception'     => $this->formatExceptionForLogging($e),
                ]
            );

            return [];
        } catch (GuzzleException $e) {
            Log::error(
                'Failed to fetch Star Wars starships due to issues with the API call.',
                [
                    'logType'       => LogTypes::STAR_WARS,
                    'exception'     => $this->formatExceptionForLogging($e),
                ]
            );

            return [];
        }
    }
}
