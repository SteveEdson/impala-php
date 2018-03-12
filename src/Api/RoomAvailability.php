<?php

namespace Impala\Api;

use Carbon\Carbon;
use \InvalidArgumentException;

trait RoomAvailability
{
    /**
     * Get all room availabilities for a hotel.
     *
     * @param array $params Optional params to be passed to request.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getRoomAvailabilities(array $params = [])
    {
        if (isset($params['startDate']) ^ isset($params['endDate'])) {
            throw new InvalidArgumentException(
                'getRoomAvailabilities requires both startDate and endDate (or neither)'
            );
        }

        if (isset($params['startDate'])) {
            $params['startDate'] = $this->formatDate($params['startDate']);
            $params['endDate'] = $this->formatDate($params['endDate']);
        }

        $route = ['room'];
        if (isset($params['roomId'])) {
            $route[] = $params['roomId'];
        }
        $route[] = 'availability';

        unset($params['roomId']);

        return $this->get(implode('/', $route), $params);
    }
}
