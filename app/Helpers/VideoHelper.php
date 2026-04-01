<?php

namespace App\Helpers;

use getID3;

class VideoHelper
{
    public static function getDurationFromUrl($url)
    {
        $getID3 = new getID3;
        $file = $getID3->analyze($url);

        if (isset($file['playtime_seconds'])) {
            $seconds = $file['playtime_seconds'];
            return gmdate("H:i:s", $seconds); // trả về dạng HH:MM:SS
        }

        return null;
    }
}