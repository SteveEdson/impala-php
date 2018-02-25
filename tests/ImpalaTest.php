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

        $this->assertInstanceOf(Hotel::class, $impala->getHotel(1));
    }
}
