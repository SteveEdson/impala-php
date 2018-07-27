<?php

use Impala\Api;
use Impala\Hotel;
use PHPUnit\Framework\TestCase;

class RateSetTest extends TestCase
{
    protected function createApiMock()
    {
        return $this->getMockBuilder(Api::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testGetRateSetsCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
            ->method('makeRequest')
            ->with(
                $this->equalTo('GET'),
                $this->equalTo('hotel/hotelId/rate-set')
            );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getRateSets();
    }
}
