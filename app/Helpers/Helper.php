<?php

namespace App\Helpers;

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


}