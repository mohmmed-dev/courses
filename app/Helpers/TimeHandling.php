<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class TimeHandling
{
// ملف Helpers.php أو في Controller مباشرة

public static function TimeToSeconds($time)
{
    if($time == 0) {
        return 0;
    }
    list($h, $m, $s) = explode(':', $time);
    return ($h * 3600) + ($m * 60) + $s;
}

public static function SecondsToTime($seconds)
{
    $hours = floor($seconds / 3600);
    $minutes = floor(($seconds % 3600) / 60);
    $seconds = $seconds % 60;

    return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
}

// البيانات من مصادر مختلفة
//$source1 = '01:30:15';
//$source2 = '00:45:00';
//$source3 = '02:00:30';

// تحويل كل مصدر إلى ثوانٍ
//$totalSeconds = timeToSeconds($source1) + timeToSeconds($source2) + timeToSeconds($source3);

// تحويل المجموع إلى تنسيق الوقت
//$totalTime = secondsToTime($totalSeconds);

// echo $totalTime; // الناتج: 04:15:45

}


