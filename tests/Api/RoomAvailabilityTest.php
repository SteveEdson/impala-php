<?php

use Impala\Api;
use Impala\Hotel;
use PHPUnit\Framework\TestCase;

class RoomAvailabilityTest extends TestCase
{
    protected function createApiMock()
    {
        return $this->getMockBuilder(Api::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testGetRoomAvailabilitiesCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
             ->method('makeRequest')
             ->with(
                 $this->equalTo('GET'),
                 $this->equalTo('hotel/hotelId/room/availability')
             );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getRoomAvailabilities();
    }

    public function testItCallsTheCorrectEndPointWhenARateIdIsPassedIn()
    {
        $mock = $this->createApiMock();

        $params = [
            'roomId' => 456
        ];
        $mock->expects($this->once())
             ->method('makeRequest')
             ->with(
                 $this->equalTo('GET'),
                 $this->equalTo('hotel/hotelId/room/456/availability')
             );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getRoomAvailabilities($params);
    }

    public function testItWorksWhenARoomTypeIdIsPassed()
    {
        $mock = $this->createApiMock();

        $params = [
            'roomTypeId' => 123
        ];
        $mock->expects($this->once())
             ->method('makeRequest')
             ->with(
                 $this->equalTo('GET'),
                 $this->equalTo('hotel/hotelId/room/availability'),
                 $this->equalTo(['query' => $params])
             );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getRoomAvailabilities($params);
    }

    public function testErrorIsReturnedIfOnlyStartDateIsPassed()
    {
        $mock = $this->createApiMock();

        $params = [
            'startDate' => '2018-01-01',
        ];

        $hotel = new Hotel('hotelId', $mock);

        $this->expectException(\InvalidArgumentException::class);
        $hotel->getRoomAvailabilities($params);
    }

    public function testErrorIsReturnedIfOnlyEndDateIsPassed()
    {
        $mock = $this->createApiMock();

        $params = [
            'endDate' => '2018-01-01',
        ];

        $hotel = new Hotel('hotelId', $mock);

        $this->expectException(\InvalidArgumentException::class);
        $hotel->getRoomAvailabilities($params);
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
                 $this->equalTo('hotel/hotelId/room/availability'),
                 $this->equalTo(['query' => $params])
             );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getRoomAvailabilities($params);
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
                 $this->equalTo('hotel/hotelId/room/availability'),
                 $this->equalTo([
                     'query' => [
                         'startDate' => '2018-01-01',
                         'endDate' => '2018-01-02',
                     ]
                 ])
             );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getRoomAvailabilities($params);
    }

    public function testItAcceptsAllParametersAtOnce()
    {
        $mock = $this->createApiMock();

        $params = [
            'roomId' => 456,
            'startDate' => '01-01-2018',
            'endDate' => '02-01-2018',
        ];
        $mock->expects($this->once())
             ->method('makeRequest')
             ->with(
                 $this->equalTo('GET'),
                 $this->equalTo('hotel/hotelId/room/456/availability'),
                 $this->equalTo([
                     'query' => [
                         'startDate' => '2018-01-01',
                         'endDate' => '2018-01-02',
                     ]
                 ])
             );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getRoomAvailabilities($params);
    }
}
