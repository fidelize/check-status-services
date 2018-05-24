<?php
namespace fidelize\CheckStatusServices;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Config;

abstract class CheckStatus
{
    protected $config;

    public function check()
    {
        $driver = ucfirst(Config::get($this->config));
        $method = "check{$driver}";

        if (!method_exists($this, $method)) {
            return false;
        }

        return $this->{$method}();
    }

    public function checkRedis()
    {
        try {
            $redisConnection = Redis::connection();
            return $redisConnection->ping();
        } catch (\Exception $exception) {
            return false;
        }
    }
}
