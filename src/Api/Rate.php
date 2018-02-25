<?php

namespace Impala\Api;

trait Rate
{
    /**
     * Get all rates for a hotel.
     *
     * @param array $params Optional params to be passed to request.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getRates(array $params = [])
    {
        return $this->get('rate', $params);
    }

    /**
     * Get a specific rate given its ID.
     *
     * @param  int $rateId ID of the rate to retrieve.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getRateById(int $rateId)
    {
        return $this->get('rate/' . $rateId);
    }
}
