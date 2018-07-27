<?php

namespace Impala\Api;

trait RateSet
{
    /**
     * Get all rate sets for a hotel.
     *
     * @param array $params Optional params to be passed to request.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getRateSets(array $params = [])
    {
        return $this->get('rate-set', $params);
    }
}
