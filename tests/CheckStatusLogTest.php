<?php

namespace fidelize\CheckStatusServices;

use Illuminate\Support\Facades\Log;
use PHPUnit\Framework\TestCase;

class CheckStatusLogTest extends TestCase
{
    public function testCheckShouldReturnTrueWhenStatusLogIsOk()
    {
        Log::shouldReceive('info')
            ->once()
            ->andReturn(true);
        $this->assertTrue((new CheckStatusLog())->check());
    }

    public function testCheckShouldReturnFalseWhenStatusLogIsNotOk()
    {
        Log::shouldReceive('info')
            ->once()
            ->andThrow(new \Exception);
        $this->assertFalse((new CheckStatusLog())->check());
    }
}
