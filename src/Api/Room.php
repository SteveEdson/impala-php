<?php

namespace Impala\Api;

trait Room
{
    /**
     * Get all rooms for a hotel.
     *
     * @param array $params Optional params to be passed to request.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getRooms(array $params = [])
    {
        return $this->get('room', $params);
    }

    /**
     * Get a specific room given its ID.
     *
     * @param string $roomId ID of the room to retrieve.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getRoomById(string $roomId)
    {
        return $this->get('room/' . $roomId);
    }
}
