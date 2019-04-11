<?php

class Config {

    /**
     * @var string 網站跟目錄（相對位置）
     */
    public static $Root = "/bang.mvc/";
    public static $Path = __DIR__;

    /**
     * @var string 網站名稱(會出現在Title 後至)
     */
    public static $SiteName = "Bang MVC API";

    //資料庫各項連線設定
    const DbName = "bang_mvc_api";
    const DbHost = "localhost";
    const DbPort = "3306";
    const DbUser = "root";
    const DbPassword = "123456";
    const EnablePHPErrorReport = true;

}

class ConfigMemecache {

    const Enable = false;
    const Host = "localhost";
    const Port = 11211;

}

class ApiConfig {

    const LogError = true;
    const LogResponse = false;
    const LogRequest = false;
    const LoadingRecords = true;
    const Key = 'bang_api_test';

}
