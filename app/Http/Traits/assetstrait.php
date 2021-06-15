<?php

namespace App\Http\Controllers;

namespace App\Http\Traits;

use App\account;
use App\agents;
use App\assets;
use App\cp_transactions;
use App\deposits;
use App\investments;
use App\plans;
use App\settings;
use App\tp_transactions;
use App\user_plans;
use App\users;
use App\withdrawals;
use DB;

trait assetstrait
{
    //Get any coin, any currency rate
    public function get_rates($coin, $currency, $option)
    {
        //get settings
        $settings = settings::where('id', '1')->first();
        $url = "https://api.cryptonator.com/api/ticker/$coin-$currency";
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_USERAGENT, "$settings->site_name");
        $query = curl_exec($curl_handle);
        curl_close($curl_handle);
        $data = json_decode($query, true);
        $price = $data["ticker"]["price"];
        if ($option == "price") {
            return $price;
        } else {
            //
            return $data;
        }
    }
}

