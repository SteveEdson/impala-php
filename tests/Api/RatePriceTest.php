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
                 $this->equalTo('hotel/hotelId/rate/price')
             );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getRatePrices();
    }

    public function testItCallsTheCorrectEndPointWhenARateIdIsPassedIn()
    {
        $mock = $this->createApiMock();

        $params = [
            'rateId' => 456
        ];
        $mock->expects($this->once())
             ->method('makeRequest')
             ->with(
                 $this->equalTo('GET'),
                 $this->equalTo('hotel/hotelId/rate/456/price')
             );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getRatePrices($params);
    }

    public function testItWorksWhenARoomTypeIdIsPassed()
    {
        $mock = $this->createApiMock();

        $params = [
            'roomTypeId' => 123
        ];
        $mock->expects($this->once())
             ->method('makeRequest')
             ->with(
                 $this->equalTo('GET'),
                 $this->equalTo('hotel/hotelId/rate/price'),
                 $this->equalTo(['query' => $params])
             );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getRatePrices($params);
    }

    public function testErrorIsReturnedIfOnlyStartDateIsPassed()
    {
        $mock = $this->createApiMock();

        $params = [
            'startDate' => '2018-01-01',
        ];

        $hotel = new Hotel('hotelId', $mock);

        $this->expectException(\InvalidArgumentException::class);
        $hotel->getRatePrices($params);
    }

    public function testErrorIsReturnedIfOnlyEndDateIsPassed()
    {
        $mock = $this->createApiMock();

        $params = [
            'endDate' => '2018-01-01',
        ];

        $hotel = new Hotel('hotelId', $mock);

        $this->expectException(\InvalidArgumentException::class);
        $hotel->getRatePrices($params);
    }

    public function testItWorksWhenBothDatesIsPassed()
    {
        $mock = $this->createApiMock();

        $params = [
            'startDate' => '2018-01-01',
            'endDate' => '2018-01-02',
        ];
        $mock->expects($this->once())
             ->method('makeRequest')
             ->with(
                 $this->equalTo('GET'),
                 $this->equalTo('hotel/hotelId/rate/price'),
                 $this->equalTo(['query' => $params])
             );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getRatePrices($params);
    }

    public function testDatesGetFormatted()
    {
        $mock = $this->createApiMock();

        $params = [
            'startDate' => '01-01-2018',
            'endDate' => '02-01-2018',
        ];
        $mock->expects($this->once())
             ->method('makeRequest')
             ->with(
                 $this->equalTo('GET'),
                 $this->equalTo('hotel/hotelId/rate/price'),
                 $this->equalTo([
                     'query' => [
                         'startDate' => '2018-01-01',
                         'endDate' => '2018-01-02',
                     ]
                 ])
             );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getRatePrices($params);
    }

    public function testItAcceptsAllParametersAtOnce()
    {
        $mock = $this->createApiMock();

        $params = [
            'rateId' => 456,
            'startDate' => '01-01-2018',
            'endDate' => '02-01-2018',
            'roomTypeId' => 123
        ];
        $mock->expects($this->once())
             ->method('makeRequest')
             ->with(
                 $this->equalTo('GET'),
                 $this->equalTo('hotel/hotelId/rate/456/price'),
                 $this->equalTo([
                     'query' => [
                         'startDate' => '2018-01-01',
                         'endDate' => '2018-01-02',
                         'roomTypeId' => 123
                     ]
                 ])
             );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getRatePrices($params);
    }
}
