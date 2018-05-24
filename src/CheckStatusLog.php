<?php

namespace fidelize\CheckStatusServices;
use Illuminate\Support\Facades\Log;

class CheckStatusLog
{
    public function check()
    {
        try {
            Log::info('Web log OK!');
            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }
}
