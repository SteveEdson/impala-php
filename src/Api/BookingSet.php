<?php

namespace Impala\Api;

trait BookingSet
{
    /**
     * Get all booking sets for a hotel.
     *
     * @param array $params Optional params to be passed to request.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getBookingSets(array $params = [])
    {
        return $this->get('booking-set', $params);
    }

    /**
     * Get a specific booking set given its ID.
     *
     * @param string $bookingSetId ID of the booking set to retrieve.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getBookingSetById(string $bookingSetId)
    {
        return $this->get('booking-set/' . $bookingSetId);
    }

    /**
     * Create a new booking set.
     *
     * @param array $data The data to create the new booking set.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function createBookingSet(array $data)
    {
        return $this->post('booking-set', [], $data);
    }

    /**
     * Update a specific booking set given its ID.
     *
     * @param string $bookingSetId ID of the booking set to update.
     * @param array  $data         The updates to be applied to the booking set.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateBookingSet(string $bookingSetId, array $data)
    {
        return $this->patch('booking-set/' . $bookingSetId, [], $data);
    }
}
