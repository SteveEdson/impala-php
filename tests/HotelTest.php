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

    public function testPatchRequestIsMade()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
            ->method('makeRequest')
            ->with(
                $this->equalTo('PATCH'),
                $this->equalTo('hotel/hotelId/testUrl'),
                $this->equalTo([
                    'query' => ['testParams'],
                    'json' => ['testData'],
                ])
            );

        $hotel = new Hotel('hotelId', $mock);
        $hotel->patch('testUrl', ['testParams'], ['testData']);
    }

    public function testPostRequestIsMade()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
            ->method('makeRequest')
            ->with(
                $this->equalTo('POST'),
                $this->equalTo('hotel/hotelId/testUrl'),
                $this->equalTo([
                    'query' => ['testParams'],
                    'json' => ['testData'],
                ])
            );

        $hotel = new Hotel('hotelId', $mock);
        $hotel->post('testUrl', ['testParams'], ['testData']);
    }

    public function testPutRequestIsMade()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
            ->method('makeRequest')
            ->with(
                $this->equalTo('PUT'),
                $this->equalTo('hotel/hotelId/testUrl'),
                $this->equalTo([
                    'query' => ['testParams'],
                    'json' => ['testData'],
                ])
            );

        $hotel = new Hotel('hotelId', $mock);
        $hotel->put('testUrl', ['testParams'], ['testData']);
    }
}
