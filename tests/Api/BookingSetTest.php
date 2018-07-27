<?php

use Impala\Api;
use Impala\Hotel;
use PHPUnit\Framework\TestCase;

class BookingSetTest extends TestCase
{
    protected function createApiMock()
    {
        return $this->getMockBuilder(Api::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testGetBookingSetsCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
            ->method('makeRequest')
            ->with(
                $this->equalTo('GET'),
                $this->equalTo('hotel/hotelId/booking-set')
            );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getBookingSets();
    }

    public function testGetBookingSetByIdCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
            ->method('makeRequest')
            ->with(
                $this->equalTo('GET'),
                $this->equalTo('hotel/hotelId/booking-set/bookingSetId')
            );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getBookingSetById('bookingSetId');
    }

    public function testCreateBookingSetPassesDataCorrectly()
    {
        $mock = $this->createApiMock();

        $data = ['parentId' => 123456, 'reference' => 'reference'];

        $mock->expects($this->once())
            ->method('makeRequest')
            ->with(
                $this->equalTo('POST'),
                $this->equalTo('hotel/hotelId/booking-set'),
                $this->equalTo([
                    'json' => $data,
                    'query' => []
                ])
            );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->createBookingSet($data);
    }

    public function testUpdateBookingSetByIdCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $data = ['parentId' => 123456, 'reference' => 'reference'];

        $mock->expects($this->once())
            ->method('makeRequest')
            ->with(
                $this->equalTo('PATCH'),
                $this->equalTo('hotel/hotelId/booking-set/bookingId'),
                $this->equalTo([
                    'json' => $data,
                    'query' => []
                ])
            );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->updateBookingSet('bookingId', $data);
    }
}
