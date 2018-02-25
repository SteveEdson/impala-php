<?php

use Impala\Api;
use Impala\Hotel;
use PHPUnit\Framework\TestCase;

class RateTest extends TestCase
{
    protected function createApiMock()
    {
        return $this->getMockBuilder(Api::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testGetRatesCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
             ->method('makeRequest')
             ->with(
                 $this->equalTo('GET'),
                 $this->equalTo('hotel/1/rate')
             );

        $hotel = new Hotel(1, $mock);

        $hotel->getRates();
    }

    public function testGetRateByIdCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
             ->method('makeRequest')
             ->with(
                 $this->equalTo('GET'),
                 $this->equalTo('hotel/1/rate/1')
             );

        $hotel = new Hotel(1, $mock);

        $hotel->getRateById(1);
    }
}
