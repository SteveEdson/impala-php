<?php

namespace Impala;

use Carbon\Carbon;
use Impala\ApiInterface;
use Impala\Api\Allocation;
use Impala\Api\Area;
use Impala\Api\AreaType;
use Impala\Api\Bill;
use Impala\Api\Booking;
use Impala\Api\BookingSet;
use Impala\Api\Extra;
use Impala\Api\Guest;
use Impala\Api\RatePlan;
use Impala\Api\RatePrice;
use Impala\Api\RateSet;


/**
 * Representation of a Hotel.
 */
class Hotel
{
    use Allocation, Area, AreaType, Bill, Booking, BookingSet, Extra, Guest,
        RatePlan, RatePrice, RateSet;

    /**
     * The hotel ID.
     *
     * @var string
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
     * @param string       $id  The hotel ID.
     * @param ApiInterface $api The service to make API calls.
     */
    public function __construct(string $id, ApiInterface $api)
    {
        $this->id = $id;
        $this->api = $api;
    }

    /**
     * Returns the hotel id.
     *
     * @return string
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
        return $this->request('GET', $endpoint, $params);
    }

    /**
     * Makes a PATCH request to the hotel endpoint of the Impala API.
     *
     * @param string $endpoint The endpoint of the API to call.
     * @param array  $params   Optional parameters to be passed in the request.
     * @param array  $body     The request body to be sent as JSON.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function patch(string $endpoint, array $params = [], array $body = null)
    {
        return $this->request('PATCH', $endpoint, $params, $body);
    }

    /**
     * Makes a POST request to the hotel endpoint of the Impala API.
     *
     * @param string $endpoint The endpoint of the API to call.
     * @param array  $params   Optional parameters to be passed in the request.
     * @param array  $body     The request body to be sent as JSON.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function post(string $endpoint, array $params = [], array $body = null)
    {
        return $this->request('POST', $endpoint, $params, $body);
    }

    /**
     * Makes a PUT request to the hotel endpoint of the Impala API.
     *
     * @param string $endpoint The endpoint of the API to call.
     * @param array  $params   Optional parameters to be passed in the request.
     * @param array  $body     The request body to be sent as JSON.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function put(string $endpoint, array $params = [], array $body = null)
    {
        return $this->request('PUT', $endpoint, $params, $body);
    }

    protected function request(
        string $method,
        string $endpoint,
        array $params = [],
        array $body = null
    ) {
        $url = 'hotel/' . $this->getId() . '/' . $endpoint;
        $options = [
            'query' => $params
        ];
        if ($body) {
            $options['json'] = $body;
        }

        return $this->api->makeRequest($method, $url, $options);
    }

    /**
     * Formats a date input.
     *
     * @param  string $date The date input string.
     * @return string
     */
    protected function formatDate(string $date)
    {
        return Carbon::parse($date)->format('Y-m-d');
    }
}
