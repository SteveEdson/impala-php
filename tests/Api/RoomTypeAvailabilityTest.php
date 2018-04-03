<?php

use Impala\Api;
use Impala\Hotel;
use PHPUnit\Framework\TestCase;

class RoomTypeAvailabilityTest extends TestCase
{
    protected function createApiMock()
    {
        return $this->getMockBuilder(Api::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testGetRoomTypeAvailabilitiesCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
             ->method('makeRequest')
             ->with(
                 $this->equalTo('GET'),
                 $this->equalTo('hotel/hotelId/room-type/availability')
             );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getRoomTypeAvailabilities();
    }

    public function testItCallsTheCorrectEndPointWhenARoomTypeIdIsPassedIn()
    {
        $mock = $this->createApiMock();

        $params = [
            'roomTypeId' => 456
        ];
        $mock->expects($this->once())
             ->method('makeRequest')
             ->with(
                 $this->equalTo('GET'),
                 $this->equalTo('hotel/hotelId/room-type/456/availability')
             );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getRoomTypeAvailabilities($params);
    }

    public function testErrorIsReturnedIfOnlyStartDateIsPassed()
    {
        $mock = $this->createApiMock();

        $params = [
            'startDate' => '2018-01-01',
        ];

        $hotel = new Hotel('hotelId', $mock);

        $this->expectException(\InvalidArgumentException::class);
        $hotel->getRoomTypeAvailabilities($params);
    }

    public function testErrorIsReturnedIfOnlyEndDateIsPassed()
    {
        $mock = $this->createApiMock();

        $params = [
            'endDate' => '2018-01-01',
        ];

        $hotel = new Hotel('hotelId', $mock);

        $this->expectException(\InvalidArgumentException::class);
        $hotel->getRoomTypeAvailabilities($params);
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
                 $this->equalTo('hotel/hotelId/room-type/availability'),
                 $this->equalTo(['query' => $params])
             );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getRoomTypeAvailabilities($params);
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
                 $this->equalTo('hotel/hotelId/room-type/availability'),
                 $this->equalTo([
                     'query' => [
                         'startDate' => '2018-01-01',
                         'endDate' => '2018-01-02',
                     ]
                 ])
             );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getRoomTypeAvailabilities($params);
    }

    public function testItAcceptsAllParametersAtOnce()
    {
        $mock = $this->createApiMock();

        $params = [
            'roomTypeId' => 456,
            'startDate' => '01-01-2018',
            'endDate' => '02-01-2018',
        ];
        $mock->expects($this->once())
             ->method('makeRequest')
             ->with(
                 $this->equalTo('GET'),
                 $this->equalTo('hotel/hotelId/room-type/456/availability'),
                 $this->equalTo([
                     'query' => [
                         'startDate' => '2018-01-01',
                         'endDate' => '2018-01-02',
                     ]
                 ])
             );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getRoomTypeAvailabilities($params);
    }
}
