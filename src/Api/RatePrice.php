<?php

namespace Impala\Api;

trait RatePrice
{
    /**
     * Get all rate prices for a hotel.
     *
     * @param array $params Optional params to be passed to request.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getRatePrices(array $params = [])
    {
        return $this->get('rate-price', $params);
    }

    /**
     * Get a specific rate price given its ID.
     *
     * @param string $ratePriceId ID of the rate price to retrieve.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getRatePriceById(string $ratePriceId)
    {
        return $this->get('rate-price/' . $ratePriceId);
    }
}
