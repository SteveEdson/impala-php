<?php

use Impala\Api;
use Impala\Hotel;
use PHPUnit\Framework\TestCase;

class AllocationTest extends TestCase
{
    protected function createApiMock()
    {
        return $this->getMockBuilder(Api::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testGetAllocationsCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
            ->method('makeRequest')
            ->with(
                $this->equalTo('GET'),
                $this->equalTo('hotel/hotelId/allocation')
            );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getAllocations();
    }

    public function testGetAllocationByIdCallsCorrectUrl()
    {
        $mock = $this->createApiMock();

        $mock->expects($this->once())
            ->method('makeRequest')
            ->with(
                $this->equalTo('GET'),
                $this->equalTo('hotel/hotelId/allocation/allocationId')
            );

        $hotel = new Hotel('hotelId', $mock);

        $hotel->getAllocationById('allocationId');
    }
}
