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
                 $this->equalTo('hotel/1/guest')
             );

        $hotel = new Hotel(1, $mock);

        $hotel->getGuests();
    }

    public function testGetGuestByIdCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
             ->method('makeRequest')
             ->with(
                 $this->equalTo('GET'),
                 $this->equalTo('hotel/1/guest/1')
             );

        $hotel = new Hotel(1, $mock);

        $hotel->getGuestById(1);
    }
}
