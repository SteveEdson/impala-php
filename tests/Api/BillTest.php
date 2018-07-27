<?php

use Impala\Api;
use Impala\Hotel;
use PHPUnit\Framework\TestCase;

class BillTest extends TestCase
{
    protected function createApiMock()
    {
        return $this->getMockBuilder(Api::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testGetBillByIdCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
            ->method('makeRequest')
            ->with(
                $this->equalTo('GET'),
                $this->equalTo('hotel/hotelId/bill/billId')
            );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getBillById('billId');
    }

    public function testGetChargesForBillCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
            ->method('makeRequest')
            ->with(
                $this->equalTo('GET'),
                $this->equalTo('hotel/hotelId/bill/billId/charge')
            );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getChargesForBill('billId');
    }

    public function testGetChargeByIdForBillCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
            ->method('makeRequest')
            ->with(
                $this->equalTo('GET'),
                $this->equalTo('hotel/hotelId/bill/billId/charge/chargeId')
            );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getChargeByIdForBill('billId', 'chargeId');
    }

    public function testCreateChargeForBillPassesDataCorrectly()
    {
        $mock = $this->createApiMock();

        $chargeData = ['grossAmount' => 123456, 'taxRate' => 0.5];

        $mock->expects($this->once())
             ->method('makeRequest')
             ->with(
                $this->equalTo('POST'),
                $this->equalTo('hotel/hotelId/bill/billId/charge'),
                $this->equalTo([
                    'json' => $chargeData,
                    'query' => []
                ])
            );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->createChargeForBill('billId', $chargeData);
    }

    public function testRefundChargeByIdForBillCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
            ->method('makeRequest')
            ->with(
                $this->equalTo('POST'),
                $this->equalTo('hotel/hotelId/bill/billId/charge/chargeId/refund'),
                $this->equalTo([
                    'query' => []
                ])
            );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->refundChargeByIdForBill('billId', 'chargeId');
    }

    public function testGetPaymentsForBillCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
            ->method('makeRequest')
            ->with(
                $this->equalTo('GET'),
                $this->equalTo('hotel/hotelId/bill/billId/payment')
            );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getPaymentsForBill('billId');
    }

    public function testGetPaymentByIdForBillCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
            ->method('makeRequest')
            ->with(
                $this->equalTo('GET'),
                $this->equalTo('hotel/hotelId/bill/billId/payment/paymentId')
            );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getPaymentByIdForBill('billId', 'paymentId');
    }

    public function testCreatePaymentForBillPassesDataCorrectly()
    {
        $mock = $this->createApiMock();

        $data = ['grossAmount' => 123456, 'description' => 'Description'];

        $mock->expects($this->once())
            ->method('makeRequest')
            ->with(
                $this->equalTo('POST'),
                $this->equalTo('hotel/hotelId/bill/billId/payment'),
                $this->equalTo([
                    'json' => $data,
                    'query' => []
                ])
            );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->createPaymentForBill('billId', $data);
    }

    public function testRefundPaymentByIdForBillCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
            ->method('makeRequest')
            ->with(
                $this->equalTo('POST'),
                $this->equalTo('hotel/hotelId/bill/billId/payment/paymentId/refund'),
                $this->equalTo([
                    'query' => []
                ])
            );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->refundPaymentByIdForBill('billId', 'paymentId');
    }
}
