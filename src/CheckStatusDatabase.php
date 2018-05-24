<?php

namespace fidelize\CheckStatusServices;

use Illuminate\Support\Facades\DB;

class CheckStatusDatabase extends CheckStatus
{
    public function check()
    {
        try {
            DB::connection()->getPdo();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
