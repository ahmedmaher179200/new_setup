<?php

namespace App\Traits;

use App\Models\Setting;
use DateTime;
use DateTimeZone;

trait helper
{
    public static function date_format($date){
        $setting = Setting::first();

        $newDate = new DateTime($date, new DateTimeZone(env('TIMEZONE', 'Africa/Cairo')) ); //in defoult timezone
        $newDate->setTimeZone(new DateTimeZone($setting->time_zone)); // in setting time_zone

        return $newDate->format($setting->date_format);
    }
}