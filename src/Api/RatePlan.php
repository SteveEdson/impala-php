<?php

namespace Impala\Api;

use \InvalidArgumentException;

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

    /**
     * Get the price of a rate plan.
     *
     * @param string $ratePlanId ID of the rate plan.
     * @param array  $params     Params to be passed to request.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getPriceForRatePlan(string $ratePlanId, array $params)
    {
        if (!isset($params['startDate']) || !isset($params['endDate'])) {
            throw new InvalidArgumentException(
                'getPriceForRatePlan requires both startDate and endDate'
            );
        }

        $params['startDate'] = $this->formatDate($params['startDate']);
        $params['endDate'] = $this->formatDate($params['endDate']);

        return $this->get('rate-plan/' . $ratePlanId . '/price', $params);
    }

    /**
     * Update the price of a rate plan.
     *
     * @param string $ratePlanId ID of the rate plan to update.
     * @param array  $data       The updates to be applied to the rate plan.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updatePriceForRatePlan(string $ratePlanId, array $data)
    {
        if (!isset($data['date'])) {
            throw new InvalidArgumentException(
                'updatePriceForRatePlan requires date'
            );
        }

        if (!isset($data['amountDescription'])) {
            throw new InvalidArgumentException(
                'updatePriceForRatePlan requires amountDescription'
            );
        }

        $data['date'] = $this->formatDate($data['date']);

        return $this->put('rate-plan/' . $ratePlanId . '/price', [], $data);
    }
}
