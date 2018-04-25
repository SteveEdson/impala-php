<?php

use Impala\Api;
use Impala\Hotel;
use PHPUnit\Framework\TestCase;

class BookingTest extends TestCase
{
    protected function createApiMock()
    {
        return $this->getMockBuilder(Api::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testGetBookingsCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
             ->method('makeRequest')
             ->with(
                 $this->equalTo('GET'),
                 $this->equalTo('hotel/1/booking')
             );

        $hotel = new Hotel(1, $mock);

        $hotel->getBookings();
    }

    public function testGetBookingByIdCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
             ->method('makeRequest')
             ->with(
                 $this->equalTo('GET'),
                 $this->equalTo('hotel/hotelId/booking/bookingId')
             );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getBookingById('bookingId');
    }

    public function testErrorIsReturnedIfOnlyStartDateIsPassed()
    {
        $mock = $this->createApiMock();

        $params = [
            'startDate' => '2018-01-01',
        ];

        $hotel = new Hotel('hotelId', $mock);

        $this->expectException(\InvalidArgumentException::class);
        $hotel->getBookings($params);
    }

    public function testErrorIsReturnedIfOnlyEndDateIsPassed()
    {
        $mock = $this->createApiMock();

        $params = [
            'endDate' => '2018-01-01',
        ];

        $hotel = new Hotel('hotelId', $mock);

        $this->expectException(\InvalidArgumentException::class);
        $hotel->getBookings($params);
    }

    public function testItWorksWhenBothDatesIsPassed()
    {
        $mock = $this->createApiMock();

        $params = [
            'startDate' => '2018-01-01',
            'endDate' => '2018-01-02',
        ];
        $mock->expects($this->once())
             ->method('makeRequest')
             ->with(
                 $this->equalTo('GET'),
                 $this->equalTo('hotel/hotelId/booking'),
                 $this->equalTo(['query' => $params])
             );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getBookings($params);
    }

    public function testDatesGetFormatted()
    {
        $mock = $this->createApiMock();

        $params = [
            'startDate' => '01-01-2018',
            'endDate' => '02-01-2018',
        ];
        $mock->expects($this->once())
             ->method('makeRequest')
             ->with(
                 $this->equalTo('GET'),
                 $this->equalTo('hotel/hotelId/booking'),
                 $this->equalTo([
                     'query' => [
                         'startDate' => '2018-01-01',
                         'endDate' => '2018-01-02',
                     ]
                 ])
             );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getBookings($params);
    }

    public function testUpdateBookingByIdCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $bookingData = ['start' => 123456, 'roomIds' => ['abc', 'cde']];

        $mock->expects($this->once())
             ->method('makeRequest')
             ->with(
                 $this->equalTo('PATCH'),
                 $this->equalTo('hotel/hotelId/booking/bookingId'),
                 $this->equalTo([
                     'json' => $bookingData,
                     'query' => []
                ])
             );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->updateBookingById('bookingId', $bookingData);
    }
}
