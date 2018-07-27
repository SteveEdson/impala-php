<?php

use Impala\Api;
use Impala\Hotel;
use PHPUnit\Framework\TestCase;

class AreaTest extends TestCase
{
    protected function createApiMock()
    {
        return $this->getMockBuilder(Api::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testGetAreasCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
            ->method('makeRequest')
            ->with(
                $this->equalTo('GET'),
                $this->equalTo('hotel/hotelId/area')
            );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getAreas();
    }

    public function testGetAreaByIdCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
            ->method('makeRequest')
            ->with(
                $this->equalTo('GET'),
                $this->equalTo('hotel/hotelId/area/areaId')
            );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getAreaById('areaId');
    }
}
