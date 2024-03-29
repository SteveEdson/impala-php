<?php

namespace Impala\Api;

use Carbon\Carbon;
use \InvalidArgumentException;

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
        if (isset($params['startDate']) ^ isset($params['endDate'])) {
            throw new InvalidArgumentException(
                'getRatePrices requires both startDate and endDate (or neither)'
            );
        }

        if (isset($params['startDate'])) {
            $params['startDate'] = $this->formatDate($params['startDate']);
            $params['endDate'] = $this->formatDate($params['endDate']);
        }

        $route = ['rate'];
        if (isset($params['rateId'])) {
            $route[] = $params['rateId'];
        }
        $route[] = 'price';

        unset($params['rateId']);

        return $this->get(implode('/', $route), $params);
    }
}
