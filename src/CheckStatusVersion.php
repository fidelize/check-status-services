<?php

namespace fidelize\CheckStatusServices;

class CheckStatusVersion extends CheckStatus
{
    public function check()
    {
        try {
            return trim(exec('git describe'));
        } catch (\Throwable $e) {
            $version = 'Unknown version';
            $versionFile = base_path('versionInfo.inf');
            if (file_exists($versionFile)) {
		$firstLine = fgets(fopen($versionFile, 'r'));
		$array = explode(' ', $firtLine);
		if (isset($array[2])) {
		    $version = $array[2];
		}
		fclose($versionFile);
	    }
	    return $version;
        }
    }

    public function checkHashCommit()
    {
        try {
            return trim(exec('git log -n 1 --pretty=format:"%H"'));
	} catch (\Throwable $e) {
	    return 'Unknown commit';
	}
    }
}
