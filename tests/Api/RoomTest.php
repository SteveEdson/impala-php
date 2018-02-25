<?php

use Impala\Api;
use Impala\Hotel;
use PHPUnit\Framework\TestCase;

class RoomTest extends TestCase
{
    protected function createApiMock()
    {
        return $this->getMockBuilder(Api::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testGetRoomsCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
             ->method('makeRequest')
             ->with(
                 $this->equalTo('GET'),
                 $this->equalTo('hotel/1/room')
             );

        $hotel = new Hotel(1, $mock);

        $hotel->getRooms();
    }

    public function testGetRoomByIdCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
             ->method('makeRequest')
             ->with(
                 $this->equalTo('GET'),
                 $this->equalTo('hotel/1/room/1')
             );

        $hotel = new Hotel(1, $mock);

        $hotel->getRoomById(1);
    }
}
