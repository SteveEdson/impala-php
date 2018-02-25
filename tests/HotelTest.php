<?php

use Impala\Impala;
use Impala\Api;
use Impala\Hotel;
use PHPUnit\Framework\TestCase;

class HotelTest extends TestCase
{
    protected function createApiMock()
    {
        return $this->getMockBuilder(Api::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testHotelIdIsReturned()
    {
        $hotel = new Hotel(1, $this->createApiMock());

        $this->assertEquals($hotel->getId(), 1);
    }

    public function testGetRequestIsMade()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
             ->method('makeRequest')
             ->with(
                 $this->equalTo('GET'),
                 $this->equalTo('hotel/1/testUrl'),
                 $this->equalTo(['query' => ['testParams']])
             );

        $hotel = new Hotel(1, $mock);
        $hotel->get('testUrl', ['testParams']);
    }
}
