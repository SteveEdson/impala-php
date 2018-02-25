<?php

use Impala\Api;
use Impala\Hotel;
use PHPUnit\Framework\TestCase;

class RatePriceTest extends TestCase
{
    protected function createApiMock()
    {
        return $this->getMockBuilder(Api::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testGetRatePricesCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
             ->method('makeRequest')
             ->with(
                 $this->equalTo('GET'),
                 $this->equalTo('hotel/1/rate-price')
             );

        $hotel = new Hotel(1, $mock);

        $hotel->getRatePrices();
    }

    public function testGetRatePriceByIdCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
             ->method('makeRequest')
             ->with(
                 $this->equalTo('GET'),
                 $this->equalTo('hotel/1/rate-price/1')
             );

        $hotel = new Hotel(1, $mock);

        $hotel->getRatePriceById(1);
    }
}
