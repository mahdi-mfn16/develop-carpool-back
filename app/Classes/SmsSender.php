<?php

namespace App\Classes;

use Exception;
use Illuminate\Support\Facades\Log;

class SmsSender
{
    public static function sendSms($template, $mobile, $params)
    {
        try {
            $url = 'https://api.kavenegar.com/v1/'.config('setting.kavenegar_api_key').'/verify/lookup.json?receptor='.$mobile.'&template='.$template;
        
            $headers = [
                'Content-Type: application/json'
            ];
            
            // $queryParams = '';
            // foreach($params as $key => $param){
            //     $queryParams += '&'.$key.'='.$param;
            // }

            $queryParams = http_build_query($params);
            $finalUrl = $url + $queryParams;

        
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_URL, $finalUrl);
            curl_setopt($ch, CURLOPT_POST, 0);
            // curl_setopt($ch, CURLOPT_POST, 1);
            // curl_setopt($ch, CURLOPT_POSTFIELDS, $queryParams);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
            $response = curl_exec ($ch);
            $err = curl_error($ch); 
            curl_close ($ch);
            
            return $response;

        } catch (Exception $e) {
            Log::info($e->getMessage());
        }
        
    }
}