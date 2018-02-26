<?php

use Impala\Api;
use Impala\Hotel;
use PHPUnit\Framework\TestCase;

class RatePlanTest extends TestCase
{
    protected function createApiMock()
    {
        return $this->getMockBuilder(Api::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testGetRatePlansCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
             ->method('makeRequest')
             ->with(
                 $this->equalTo('GET'),
                 $this->equalTo('hotel/hotelId/rate-plan')
             );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getRatePlans();
    }

    public function testGetRatePlanByIdCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
             ->method('makeRequest')
             ->with(
                 $this->equalTo('GET'),
                 $this->equalTo('hotel/hotelId/rate-plan/ratePlanId')
             );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getRatePlanById('ratePlanId');
    }
}
