<?php
namespace fidelize\CheckStatusServices;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class CheckStatusLogWeb extends CheckStatusLog
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
