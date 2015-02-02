<?php

/**
 * 網路相關功能
 */
class Net {

    /**
     * 連結取得HTTP結果內容(POST)
     * @param string $url
     */
    public static function HttpPOST($url, $param, $timeout = 40, $https_keyname = "") {
        $curl = Net::PrepareCurl($url, $https_keyname, $timeout);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $param);

        $recall = curl_exec($curl);
        if (!$recall) {
            /* echo curl_error($curl); */
            return false;
        }
        curl_close($curl);
        return $recall;
    }

    /**
     * 連結取得HTTP結果內容(GET)
     * @param string $url
     */
    public static function HttpGET($url, $https_keyname = "") {
        $curl = Net::PrepareCurl($url, $https_keyname, 25);
        $recall = curl_exec($curl);
        if (!$recall) {
            /* echo curl_error($curl); */
            return false;
        }
        curl_close($curl);
        return $recall;
    }

    /**
     * 準備cURL請求
     * @param string $url 請求網址
     * @param type $https_keyname 是否需要SSL KEY
     * @param type $timeout 請求Timeout秒數
     * @return cURL
     */
    private static function PrepareCurl($url, $https_keyname, $timeout = 40) {
        if (substr($url, 0, 4) != "http") {
            $url = "http://" . $url;
        }
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_ENCODING, "UTF-8");
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        if (substr($url, 0, 5) == "https") {
            curl_setopt($curl, CURLOPT_PORT, 443);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            if ($https_keyname != "") {
                curl_setopt($curl, CURLOPT_SSLCERT, dirname(__FILE__) . "/{$https_keyname}.pem");
                curl_setopt($curl, CURLOPT_SSLKEY, dirname(__FILE__) . "/{$https_keyname}.key");
            }
        }
        return $curl;
    }

    /**
     * 
     * @param type $ip_address IP位置
     * @param type $username 使用者帳號
     * @param type $password 使用者密碼
     * @return ip_country_data IP位置資訊
     */
    public static function GetIpInfoFromMaxmind($ip_address, $username = "94833", $password = "APSIxx8Bn0Yf") {
        $url = "https://geoip.maxmind.com/geoip/v2.1/country/{$ip_address}?pretty";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_ENCODING, "UTF-8");
        curl_setopt($curl, CURLOPT_USERPWD, "{$username}:{$password}");
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 50);
        curl_setopt($curl, CURLOPT_TIMEOUT, 50);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        if (substr($url, 0, 5) == "https") {
            curl_setopt($curl, CURLOPT_PORT, 443);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        }
        $recall = curl_exec($curl);
        if (!$recall) {
            return false;
        }
        curl_close($curl);

        var_dump($recall);
        
        $obj_result = json_decode($recall);
        $area_code = $obj_result->continent->code;
        $area = $obj_result->continent->names->en;
        $country = $obj_result->country->names->en;
        $country_code = $obj_result->country->iso_code;

        $result = new ip_country_data();
        $result->area_code = $area_code;
        $result->area_name = $area;
        $result->country_code = $country_code;
        $result->country_name = $country;
        $result->ip = $ip_address;
        return $result;
    }

}

class ip_country_data extends MySqlTableBase {

    public $ip;
    public $area_name;
    public $area_code;
    public $country_name;
    public $country_code;

}
