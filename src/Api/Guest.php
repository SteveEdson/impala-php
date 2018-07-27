<?php

namespace Impala\Api;

use \InvalidArgumentException;

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
        if (!isset($params['startDate']) || !isset($params['endDate'])) {
            throw new InvalidArgumentException(
                'getGuests requires both startDate and endDate'
            );
        }

        $params['startDate'] = $this->formatDate($params['startDate']);
        $params['endDate'] = $this->formatDate($params['endDate']);

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

    /**
     * Create a new guest.
     *
     * @param array $data The data to create the new guest.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function createGuest(array $data)
    {
        return $this->post('guest', [], $data);
    }

    /**
     * Update a specific guest set given its ID.
     *
     * @param string $guestId ID of the guest  to update.
     * @param array  $data    The updates to be applied to the guest.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateGuest(string $guestId, array $data)
    {
        return $this->patch('guest/' . $guestId, [], $data);
    }

    /**
     * Retrieve a list of bills for a guest.
     *
     * @param string $guestId ID of the guest.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getBillsForGuest(string $guestId)
    {
        return $this->get('guest/' . $guestId . '/bill');
    }
}
