<?php

namespace App\Classes;

use App\Models\City;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use function PHPSTORM_META\type;

class AddressDetail
{
    public static function getAddressDetails($location)
    {

        try {
            
            if($location instanceof City){
                $locationAddress = $location['name'].','.$location->province->name;
            }else{
                $locationAddress = $location['name'].',ایران';
            }
            $url = 'https://nominatim.openstreetmap.org/search?addressdetails=0&q='.$locationAddress.'&format=jsonv2&limit=1';
            
            $response = Http::get($url);

            // Log::info(collect(json_decode($response,true))->first());
            return collect(json_decode($response,true))->first();

        } catch (Exception $e) {
            Log::info($e->getMessage());
        }



        // try {
            
        //     if($location instanceof City){
        //         $locationAddress = $location['name'].','.$location->province->name;
        //     }else{
        //         $locationAddress = $location['name'].',ایران';
        //     }
        //     $url = 'https://nominatim.openstreetmap.org/search?addressdetails=0&q=ایران&format=jsonv2&limit=1';
            
        //     $headers = [
        //         // 'Content-Type: application/json',
        //         'User-Agent: PostmanRuntime/7.36.3',
        //         // 'Content-type: text/html; charset=utf-8'
        //     ];

        //     Log::info(mb_convert_encoding($url, "ASCII"));


        //     $ch = curl_init();
        //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        //     curl_setopt($ch, CURLOPT_URL, mb_convert_encoding($url, "ASCII"));
        //     curl_setopt($ch, CURLOPT_POST, 0);
        //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        //     $response = curl_exec ($ch);
        //     $err = curl_error($ch); 
        //     curl_close ($ch);
        //     Log::info($response);
        //     return collect(json_decode($response,true))->first();

        // } catch (Exception $e) {
        //     Log::info($e->getMessage());
        // }
        
    }
}