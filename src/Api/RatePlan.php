<?php

namespace Impala\Api;

trait RatePlan
{
    /**
     * Get all rate plans for a hotel.
     *
     * @param array $params Optional params to be passed to request.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getRatePlans(array $params = [])
    {
        return $this->get('rate-plan', $params);
    }

    /**
     * Get a specific rate plan given its ID.
     *
     * @param string $ratePlanId ID of the rate plan to retrieve.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getRatePlanById(string $ratePlanId)
    {
        return $this->get('rate-plan/' . $ratePlanId);
    }
}
