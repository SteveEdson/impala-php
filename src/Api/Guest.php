<?php

namespace Impala\Api;

trait Guest
{
    /**
     * Get all guests for a hotel.
     *
     * @param array $params Optional params to be passed to request.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getGuests(array $params = [])
    {
        return $this->get('guest', $params);
    }

    /**
     * Get a specific guest given its ID.
     *
     * @param string $guestId ID of the guest to retrieve.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getGuestById(string $guestId)
    {
        return $this->get('guest/' . $guestId);
    }
}
