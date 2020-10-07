<?php

namespace fidelize\CheckStatusServices;

use Illuminate\Database\Connection;
use Mockery;
use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\DB;

class CheckStatusDatabaseTest extends TestCase
{
    public function testCheckShouldReturnFalseWhenDatabaseIsNotOk()
    {
        $mock = Mockery::mock(Connection::class);
        $mock->shouldReceive('getPdo')->andThrow(new \Exception);

        DB::shouldReceive('connection')
            ->once()
            ->andReturn($mock);
        $this->assertFalse((new CheckStatusDatabase())->check());
    }

    public function testCheckShouldReturnTrueWhenDatabaseIsOk()
    {
        $mock = Mockery::mock(Connection::class);
        $mock->shouldReceive('getPdo')->andReturn(true);

        DB::shouldReceive('connection')
            ->once()
            ->andReturn($mock);
        $this->assertTrue((new CheckStatusDatabase())->check());
    }

    public function testCheckShouldReturnFalseWhenConnectionIsMongodbAndDatabaseIsNotOk()
    {
        $mongoClient = Mockery::mock(\MongoDB\Client::class);
        $mongoClient->shouldReceive('listDatabases')->andThrow(new \Exception);
        $mock = Mockery::mock(\Jenssegers\Mongodb\Connection::class);
        $mock->shouldReceive('getMongoClient')->andReturn($mongoClient);

        DB::shouldReceive('connection')
            ->once()
            ->andReturn($mock);
        $this->assertFalse((new CheckStatusDatabase())->check());
    }

    public function testCheckShouldReturnTrueWhenConnectionIsMongodbAndDatabaseIsOk()
    {
        $mongoClient = Mockery::mock(\MongoDB\Client::class);
        $mongoClient->shouldReceive('listDatabases')->andReturn(true);
        $mock = Mockery::mock(\Jenssegers\Mongodb\Connection::class);
        $mock->shouldReceive('getMongoClient')->andReturn($mongoClient);

        DB::shouldReceive('connection')
            ->once()
            ->andReturn($mock);
        $this->assertTrue((new CheckStatusDatabase())->check());
    }
}
