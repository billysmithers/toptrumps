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

abstract class ResourceFetcher implements Fetcher
{
    use LogsApiException;

    protected const FILMS = 'films/';

    protected const PEOPLE = 'people/';

    protected const PLANETS = 'planets/';

    protected const SPECIES = 'species/';

    protected const STARSHIPS = 'starships/';

    protected const VEHICLES = 'vehicles/';

    private const NUMBER_OF_RESOURCES = 32;

    private const VALID_RESOURCES = [
        self::FILMS,
        self::PEOPLE,
        self::PLANETS,
        self::SPECIES,
        self::STARSHIPS,
        self::VEHICLES,
    ];

    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    protected function fetchByResourceType(string $type): array
    {
        if (! in_array($type, self::VALID_RESOURCES)) {
            throw new InvalidArgumentException(
                'Type of resource must be one of the following '
                . implode(' ', self::VALID_RESOURCES)
            );
        }

        $resources = [];
        $page      = $this->fetchPage($type);

        if (empty($page['results'])) {
            return [];
        }

        do {
            foreach ($page['results'] ?? [] as $result) {
                $resources[] = $result;
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
