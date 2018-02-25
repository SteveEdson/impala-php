<?php

namespace Impala\Api;

use Carbon\Carbon;
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
     * @param  int $bookingId ID of the booking to retrieve.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getBookingById(int $bookingId)
    {
        return $this->get('booking/' . $bookingId);
    }

    /**
     * Formats a date input.
     *
     * @param  string $date The date input string.
     * @return string
     */
    protected function formatDate(string $date)
    {
        return Carbon::parse($date)->format('Y-m-d');
    }
}
