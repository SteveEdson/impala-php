<?php

namespace Impala;

use Impala\ApiInterface;
use Impala\Hotel;

class Impala
{
    /**
     * Service to make requests to Impala API.
     *
     * @var Impala\Api
     */
    private $api;

    /**
     * Initializes the library.
     *
     * @param ApiInterface $api The API service.
     * @return this
     */
    public function __construct(ApiInterface $api)
    {
        $this->api = $api;
    }

    /**
     * Get a specific hotel given its ID.
     *
     * @param string $hotelId The ID of the hotel to get.
     * @return Impala\Hotel
     */
    public function getHotel(string $hotelId)
    {
        return new Hotel($hotelId, $this->api);
    }
}
