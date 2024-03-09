<?php

namespace App\Helpers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class Helper
{
    public static function generateSmsCode()
    {
        return rand(100000, 999999);
    }

    public static function generateUserName()
    {
        $string = ['ali', 'omar', 'maryam', 'sahar'];
        return  $string[array_rand($string)].rand(1000, 9999);
    }


    public static function generateChatUniqueId($length = 10)
    {
        $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $charactersLength = strlen($characters);
        $chatUniqueId = '';
        for ($i = 0; $i < $length; $i++) {
            $chatUniqueId .= $characters[rand(0, $charactersLength - 1)];
        }
        return $chatUniqueId;
    }


    public static function getLastDurationTime($startTime, $duration)
    {
        // $startTime = '20:30';
        // $duration = '02:05';
        // $endTime = '22:35';

        $startTime = Carbon::createFromFormat('H:i', $startTime); // date is today
        $parts = explode(':',$duration);

        $newTime = $startTime->copy();
        $endTime = $newTime->addHours(intval($parts[0]))->addMinutes(intval($parts[1]));  // date is today

        return $endTime->format('H:i');
    }


}