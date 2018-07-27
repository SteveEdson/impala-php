<?php

use Impala\Api;
use Impala\Hotel;
use PHPUnit\Framework\TestCase;

class AreaTypeTest extends TestCase
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
                $this->equalTo('hotel/hotelId/area-type')
            );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getAreaTypes();
    }

    public function testGetAreaByIdCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
            ->method('makeRequest')
            ->with(
                $this->equalTo('GET'),
                $this->equalTo('hotel/hotelId/area-type/areaTypeId')
            );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getAreaTypeById('areaTypeId');
    }
}
