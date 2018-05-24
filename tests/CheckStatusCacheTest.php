<?php

namespace fidelize\CheckStatusServices;

use Illuminate\Support\Facades\Config;
use Mockery;
use PHPUnit\Framework\TestCase;

class CheckStatusCacheTest extends TestCase
{
    public function testCheckShouldReturnTrueWhenMethodExist()
    {
        Config::shouldReceive('get')
            ->once()
            ->andReturn('redis');

        $mock = Mockery::mock(CheckStatusCache::class);
        $mock->shouldReceive('check')->andReturn(true);
        $this->assertTrue($mock->check());
    }

    public function testCheckShouldReturnFalseWhenMethodExistButStatusNotOk()
    {
        Config::shouldReceive('get')
            ->once()
            ->andReturn('redis');
        $mock = Mockery::mock(CheckStatusCache::class);
        $mock->shouldReceive('check')->andReturn(false);
        $this->assertFalse($mock->check());
    }

    public function testCheckShouldReturnFalseWhenMethodNotExist()
    {
        Config::shouldReceive('get')
            ->once()
            ->andReturn('memcached');
        $this->assertFalse((new CheckStatusCache())->check());
    }
}
