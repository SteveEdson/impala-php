<?php

use Impala\Api;
use Impala\Hotel;
use PHPUnit\Framework\TestCase;

class RoomTypeTest extends TestCase
{
    protected function createApiMock()
    {
        return $this->getMockBuilder(Api::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testGetRoomTypesCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
             ->method('makeRequest')
             ->with(
                 $this->equalTo('GET'),
                 $this->equalTo('hotel/1/room-type')
             );

        $hotel = new Hotel(1, $mock);

        $hotel->getRoomTypes();
    }

    public function testGetRoomTypeByIdCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
             ->method('makeRequest')
             ->with(
                 $this->equalTo('GET'),
                 $this->equalTo('hotel/1/room-type/1')
             );

        $hotel = new Hotel(1, $mock);

        $hotel->getRoomTypeById(1);
    }
}
