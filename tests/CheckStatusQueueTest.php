<?php

namespace fidelize\CheckStatusServices;

use Illuminate\Support\Facades\Config;
use Mockery;
use PHPUnit\Framework\TestCase;

class CheckStatusQueueTest extends TestCase
{
    public function testCheckShouldReturnTrueWhenMethodExistAndStatusIsOk()
    {
        Config::shouldReceive('get')
            ->once()
            ->andReturn('redis');
        $mock = Mockery::mock(CheckStatusQueue::class);
        $mock->shouldReceive('check')->andReturn(true);
        $this->assertTrue($mock->check());
    }

    public function testCheckShouldReturnFalseWhenMethodExistButStatusNotOk()
    {
        Config::shouldReceive('get')
            ->once()
            ->andReturn('redis');
        $mock = Mockery::mock(CheckStatusQueue::class);
        $mock->shouldReceive('check')->andReturn(false);
        $this->assertFalse($mock->check());
    }

    public function testCheckShouldReturnFalseWhenMethodNotExist()
    {
        Config::shouldReceive('get')
            ->once()
            ->andReturn('memcached');
        $this->assertFalse((new CheckStatusQueue())->check());
    }
}
