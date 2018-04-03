<?php

namespace Impala\Api;

use Carbon\Carbon;
use \InvalidArgumentException;

trait RoomTypeAvailability
{
    /**
     * Get all room type availabilities for a hotel.
     *
     * @param array $params Optional params to be passed to request.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getRoomTypeAvailabilities(array $params = [])
    {
        if (isset($params['startDate']) ^ isset($params['endDate'])) {
            throw new InvalidArgumentException(
                'getRoomTypeAvailabilities requires both startDate and endDate (or neither)'
            );
        }

        if (isset($params['startDate'])) {
            $params['startDate'] = $this->formatDate($params['startDate']);
            $params['endDate'] = $this->formatDate($params['endDate']);
        }

        $route = ['room-type'];
        if (isset($params['roomTypeId'])) {
            $route[] = $params['roomTypeId'];
        }
        $route[] = 'availability';

        unset($params['roomTypeId']);

        return $this->get(implode('/', $route), $params);
    }
}
