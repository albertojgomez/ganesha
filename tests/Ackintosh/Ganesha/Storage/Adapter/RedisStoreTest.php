<?php

namespace Ackintosh\Ganesha\Storage\Adapter;

use Ackintosh\Ganesha\Exception\StorageException;

class RedisStoreTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function constructorThrowsExceptionIfTheClientIsNotSupported()
    {
        new RedisStore(new \stdClass());
    }

    /**
     * @test
     * @expectedException \Ackintosh\Ganesha\Exception\StorageException
     */
    public function zCardThrowsExceptionIfFailed()
    {
        $mock = $this->getMockBuilder(\Redis::class)
            ->setMethods(['zCard'])
            ->getMock();
        $mock->expects($this->any())
            ->method('zCard')
            ->willThrowException(new \RuntimeException());

        (new RedisStore($mock))->zCard("test key");
    }
}
