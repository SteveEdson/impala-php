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
        $hotel = new Hotel('hotelId', $this->createApiMock());

        $this->assertEquals($hotel->getId(), 'hotelId');
    }

    public function testGetRequestIsMade()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
             ->method('makeRequest')
             ->with(
                 $this->equalTo('GET'),
                 $this->equalTo('hotel/hotelId/testUrl'),
                 $this->equalTo(['query' => ['testParams']])
             );

        $hotel = new Hotel('hotelId', $mock);
        $hotel->get('testUrl', ['testParams']);
    }
}
