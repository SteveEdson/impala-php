<?php

namespace Impala;

use Impala\ApiInterface;
use Impala\Api\Booking;
use Impala\Api\Guest;
use Impala\Api\Room;
use Impala\Api\RoomType;
use Impala\Api\Rate;
use Impala\Api\RatePlan;
use Impala\Api\RatePrice;

/**
 * Representation of a Hotel.
 */
class Hotel
{
    use Booking, Guest, Room, RoomType, Rate, RatePlan, RatePrice;

    /**
     * The hotel ID.
     *
     * @var integer
     */
    protected $id;

    /**
     * The service to make API calls.
     *
     * @var Impala\ApiInterface
     */
    protected $api;

    /**
     * Initializes the Hotel object setting it properties.
     *
     * @param int          $id  The hotel ID.
     * @param ApiInterface $api The service to make API calls.
     */
    public function __construct(int $id, ApiInterface $api)
    {
        $this->id = $id;
        $this->api = $api;
    }

    /**
     * Returns the hotel id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Makes a GET request to the hotel endpoint of the Impala API.
     *
     * @param string $endpoint The endpoint of the API to call.
     * @param array  $params   Optional parameters to be passed in the request.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function get(string $endpoint, array $params = [])
    {
        $url = 'hotel/' . $this->getId() . '/' . $endpoint;

        return $this->api->makeRequest('GET', $url, ['query' => $params]);
    }
}
