<?php

namespace Impala\Api;

trait RoomType
{
    /**
     * Get all room types for a hotel.
     *
     * @param array $params Optional params to be passed to request.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getRoomTypes(array $params = [])
    {
        return $this->get('room-type', $params);
    }

    /**
     * Get a specific room type given its ID.
     *
     * @param string $roomTypeId ID of the room type to retrieve.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getRoomTypeById(string $roomTypeId)
    {
        return $this->get('room-type/' . $roomTypeId);
    }
}
