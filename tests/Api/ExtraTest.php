<?php

use Impala\Api;
use Impala\Hotel;
use PHPUnit\Framework\TestCase;

class ExtraTest extends TestCase
{
    protected function createApiMock()
    {
        return $this->getMockBuilder(Api::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testGetExtrasCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
            ->method('makeRequest')
            ->with(
                $this->equalTo('GET'),
                $this->equalTo('hotel/hotelId/extra')
            );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getExtras();
    }

    public function testGetExtraByIdCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
            ->method('makeRequest')
            ->with(
                $this->equalTo('GET'),
                $this->equalTo('hotel/hotelId/extra/extraId')
            );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getExtraById('extraId');
    }
}
