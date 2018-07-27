<?php

use Impala\Api;
use Impala\Hotel;
use PHPUnit\Framework\TestCase;

class GuestTest extends TestCase
{
    protected function createApiMock()
    {
        return $this->getMockBuilder(Api::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testGetGuestsCallsCorrectUrl()
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
                $this->equalTo('hotel/hotelId/guest'),
                $this->equalTo(['query' => $params])
            );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getGuests($params);
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

    public function testGetGuestByIdCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
            ->method('makeRequest')
            ->with(
                $this->equalTo('GET'),
                $this->equalTo('hotel/hotelId/guest/guestId')
            );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getGuestById('guestId');
    }

    public function testCreateGuestPassesDataCorrectly()
    {
        $mock = $this->createApiMock();

        $data = ['parentId' => 123456, 'reference' => 'reference'];

        $mock->expects($this->once())
            ->method('makeRequest')
            ->with(
                $this->equalTo('POST'),
                $this->equalTo('hotel/hotelId/guest'),
                $this->equalTo([
                    'json' => $data,
                    'query' => []
                ])
            );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->createGuest($data);
    }

    public function testUpdateGuestByIdCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $data = ['parentId' => 123456, 'reference' => 'reference'];

        $mock->expects($this->once())
            ->method('makeRequest')
            ->with(
                $this->equalTo('PATCH'),
                $this->equalTo('hotel/hotelId/guest/guestId'),
                $this->equalTo([
                    'json' => $data,
                    'query' => []
                ])
            );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->updateGuest('guestId', $data);
    }

    public function testGetBillsForGuestCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
            ->method('makeRequest')
            ->with(
                $this->equalTo('GET'),
                $this->equalTo('hotel/hotelId/guest/guestId/bill')
            );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getBillsForGuest('guestId');
    }
}
