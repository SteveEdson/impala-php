<?php

namespace Impala;

use Impala\Api;
use Impala\Impala;
use GuzzleHttp\Client;

class ImpalaFactory
{
    /**
     * Base URL of the Impala API.
     *
     * @var string
     */
    const BASE_URL = 'https://api.getimpala.com/v2/';

    /**
     * Creates a new Impala instance.
     *
     * Injects an API service into the Impala object.
     * If a hotel ID is passed uses the Impala object to get a hotel object and
     * return it, otherwise returns the Impala object itself.
     *
     * @param string $apiKey  API key to access Impala API.
     * @param string $hotelId Optional hotel ID.
     * @return Impala\Impala|Impala\Hotel
     */
    public static function create(string $apiKey, string $hotelId = null)
    {
        $client = new Client(['base_uri' => self::BASE_URL]);
        $api = new Api($apiKey, $client);
        $impala = new Impala($api);

        if ($hotelId) {
            return $impala->getHotel($hotelId);
        }

        return $impala;
    }
}
