<?php

use Impala\Api;
use Impala\Hotel;
use PHPUnit\Framework\TestCase;

class GuestTest extends TestCase
{
    protected function createApiMock()
    {
        return $this->getMockBuilder(Api::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testGetGuestsCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
             ->method('makeRequest')
             ->with(
                 $this->equalTo('GET'),
                 $this->equalTo('hotel/hotelId/guest')
             );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getGuests();
    }

    public function testGetGuestByIdCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
             ->method('makeRequest')
             ->with(
                 $this->equalTo('GET'),
                 $this->equalTo('hotel/hotelId/guest/guestId')
             );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getGuestById('guestId');
    }
}
