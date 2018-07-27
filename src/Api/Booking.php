<?php

namespace Impala\Api;

use \InvalidArgumentException;

trait Booking
{
    /**
     * Get all bookings for a hotel.
     *
     * @param array $params Optional params to be passed to request.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getBookings(array $params = [])
    {
        if (isset($params['startDate']) ^ isset($params['endDate'])) {
            throw new InvalidArgumentException(
                'getBookings requires both startDate and endDate (or neither)'
            );
        }

        if (isset($params['startDate'])) {
            $params['startDate'] = $this->formatDate($params['startDate']);
            $params['endDate'] = $this->formatDate($params['endDate']);
        }

        return $this->get('booking', $params);
    }

    /**
     * Get a specific booking given its ID.
     *
     * @param string $bookingId ID of the booking to retrieve.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getBookingById(string $bookingId)
    {
        return $this->get('booking/' . $bookingId);
    }

    /**
     * Create a new booking.
     *
     * @param array $data The data to create the new booking.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function createBooking(array $data)
    {
        return $this->post('booking', [], $data);
    }

    /**
     * Update a specific booking given its ID.
     *
     * @param string $bookingId ID of the booking to update.
     * @param array  $data      The updates to be applied to the booking.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateBookingById(string $bookingId, array $data)
    {
        return $this->patch('booking/' . $bookingId, [], $data);
    }

    /**
     * Check in a booking.
     *
     * @param string $bookingId ID of the booking to check in.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function checkInBookingById(string $bookingId)
    {
        return $this->post('booking/' . $bookingId . '/check-in');
    }

    /**
     * Check out a booking.
     *
     * @param string $bookingId ID of the booking to check out.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function checkOutBookingById(string $bookingId)
    {
        return $this->post('booking/' . $bookingId . '/check-out');
    }

    /**
     * Cancel a booking.
     *
     * @param string $bookingId ID of the booking to cancel.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function cancelBookingById(string $bookingId)
    {
        return $this->post('booking/' . $bookingId . '/cancel');
    }

    /**
     * Retrieve a list of all guests for a booking.
     *
     * @param string $bookingId ID of the booking.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getGuestsForBooking(string $bookingId)
    {
        return $this->get('booking/' . $bookingId . '/guests');
    }

    /**
     * Retrieve a list of bills for a booking.
     *
     * @param string $bookingId ID of the booking.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getBillsForBooking(string $bookingId)
    {
        return $this->get('booking/' . $bookingId . '/bill');
    }
}
