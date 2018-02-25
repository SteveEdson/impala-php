<?php

use Impala\Impala;
use Impala\ImpalaFactory;
use Impala\Hotel;
use PHPUnit\Framework\TestCase;

class ImpalaFactoryTest extends TestCase
{
    public function testImpalaObjectIsReturnedWhenHotelIdIsNull()
    {
        $object = ImpalaFactory::create('dummy');

        $this->assertInstanceOf(Impala::class, $object);
    }

    public function testHotelObjectIsReturnedWhenPassingHotelId()
    {
        $object = ImpalaFactory::create('dummy', 1);

        $this->assertInstanceOf(Hotel::class, $object);
    }
}
