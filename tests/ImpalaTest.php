<?php

use Impala\Impala;
use Impala\Api;
use Impala\Hotel;
use PHPUnit\Framework\TestCase;

class ImpalaTest extends TestCase
{
    public function testHotelIsReturned()
    {
        $api = $this->getMockBuilder(Api::class)
            ->disableOriginalConstructor()
            ->getMock();
        $impala = new Impala($api);

        $this->assertInstanceOf(Hotel::class, $impala->getHotel('hotelId'));
    }

    public function testItCanCallMethodFromHotelClass()
    {
        $hotelMock = $this->createMock(Hotel::class);

        $mock = $this->getMockBuilder(Impala::class)
            ->disableOriginalConstructor()
            ->setMethods(['getHotel'])
            ->getMock();

        $mock->expects($this->once())
            ->method('getHotel')
            ->with($this->equalTo('hotelId'))
            ->willReturn($hotelMock);

        $hotelMock->expects($this->once())
            ->method('getBookings');

        $mock->getBookings(['hotelId' => 'hotelId']);
    }
}
