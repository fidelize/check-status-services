<?php

namespace fidelize\CheckStatusServices;

use Illuminate\Support\Facades\DB;

class CheckStatusDatabase extends CheckStatus
{
    public function check()
    {
        try {
            $connection = DB::connection();
            if ($connection instanceof \Jenssegers\Mongodb\Connection) {
                $connection->getMongoClient()->listDatabases();
                return true;
            }

            $connection->getPdo();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
