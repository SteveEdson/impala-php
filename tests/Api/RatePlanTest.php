<?php

use Impala\Api;
use Impala\Hotel;
use PHPUnit\Framework\TestCase;

class RatePlanTest extends TestCase
{
    protected function createApiMock()
    {
        return $this->getMockBuilder(Api::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testGetRatePlansCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
            ->method('makeRequest')
            ->with(
                $this->equalTo('GET'),
                $this->equalTo('hotel/hotelId/rate-plan')
            );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getRatePlans();
    }

    public function testGetRatePlanByIdCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
            ->method('makeRequest')
            ->with(
                $this->equalTo('GET'),
                $this->equalTo('hotel/hotelId/rate-plan/ratePlanId')
            );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getRatePlanById('ratePlanId');
    }

    public function testGetPriceForRatePlanCallsCorrectUrl()
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
                $this->equalTo('hotel/hotelId/rate-plan/ratePlanId/price'),
                $this->equalTo(['query' => $params])
            );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getPriceForRatePlan('ratePlanId', $params);
    }

    public function testErrorIsReturnedIfNoDatesArePassed()
    {
        $mock = $this->createApiMock();

        $params = ['dummyParameter' => 'test'];

        $hotel = new Hotel('hotelId', $mock);

        $this->expectException(\InvalidArgumentException::class);
        $hotel->getPriceForRatePlan('ratePlanId', $params);
    }

    public function testErrorIsReturnedIfOnlyStartDateIsPassed()
    {
        $mock = $this->createApiMock();

        $params = ['startDate' => '2018-01-01'];

        $hotel = new Hotel('hotelId', $mock);

        $this->expectException(\InvalidArgumentException::class);
        $hotel->getPriceForRatePlan('ratePlanId', $params);
    }

    public function testErrorIsReturnedIfOnlyEndDateIsPassed()
    {
        $mock = $this->createApiMock();

        $params = ['endDate' => '2018-01-01'];

        $hotel = new Hotel('hotelId', $mock);

        $this->expectException(\InvalidArgumentException::class);
        $hotel->getPriceForRatePlan('ratePlanId', $params);
    }

    public function testDatesGetFormattedInGetPriceForRatePlan()
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
                $this->equalTo('hotel/hotelId/rate-plan/ratePlanId/price'),
                $this->equalTo([
                    'query' => [
                        'startDate' => '2018-01-01',
                        'endDate' => '2018-01-02',
                    ]
                ])
            );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getPriceForRatePlan('ratePlanId', $params);
    }

    public function testupdatePriceForRatePlanCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $data = ['date' => '2018-01-01', 'amountDescription' => 'test'];

        $mock->expects($this->once())
            ->method('makeRequest')
            ->with(
                $this->equalTo('PUT'),
                $this->equalTo('hotel/hotelId/rate-plan/ratePlanId/price'),
                $this->equalTo([
                    'json' => $data,
                    'query' => []
                ])
            );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->updatePriceForRatePlan('ratePlanId', $data);
    }

    public function testErrorIsReturnedIfDateIsNotPassed()
    {
        $mock = $this->createApiMock();

        $data = ['amountDescription' => 'test'];

        $hotel = new Hotel('hotelId', $mock);

        $this->expectException(\InvalidArgumentException::class);
        $hotel->updatePriceForRatePlan('ratePlanId', $data);
    }

    public function testErrorIsReturnedIfAmountDescriptionIsNotPassed()
    {
        $mock = $this->createApiMock();

        $data = ['date' => '2018-01-01'];

        $hotel = new Hotel('hotelId', $mock);

        $this->expectException(\InvalidArgumentException::class);
        $hotel->updatePriceForRatePlan('ratePlanId', $data);
    }

    public function testDateGetsFormattedInUpdatePriceForRatePlan()
    {
        $mock = $this->createApiMock();

        $params = ['date' => '01-01-2018', 'amountDescription' => 'test'];

        $mock->expects($this->once())
            ->method('makeRequest')
            ->with(
                $this->equalTo('PUT'),
                $this->equalTo('hotel/hotelId/rate-plan/ratePlanId/price'),
                $this->equalTo([
                    'json' => [
                        'date' => '2018-01-01',
                        'amountDescription' => 'test'
                    ],
                    'query' => [],
                ])
            );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->updatePriceForRatePlan('ratePlanId', $params);
    }
}
