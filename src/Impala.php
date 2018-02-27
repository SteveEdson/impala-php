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
     * Magic method to access hotel methods directly through an Impala object.
     *
     * @param string $method
     * @param array  $arguments
     * @return mixed
     */
    public function __call(string $method, array $arguments)
    {
        if (is_array($arguments)) {
            if (method_exists(Hotel::class, $method)) {
                $hotel = $this->getHotel($arguments[0]);
            
                // Remove hotel ID from arguments
                array_shift($arguments);

                return call_user_func_array(array($hotel, $method), $arguments);
            }
        }
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
