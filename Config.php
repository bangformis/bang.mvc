<?php

class Config {

    /**
     * @var string 網�跟目����位置��
     */
    public static $Root = "/bang.mvc/";
    public static $Path = __DIR__;

    /**
     * @var string 網��稱(�出�在Title 後至)
     */
    public static $SiteName = "Bang MVC API";

    //資�庫����設�
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

    const LogResponse = true;
    const LogType = ApiLogTypes::Daily;
    const LogError = true;
    const LogRequest = true;
    const LoadingRecords = true;
    const Key = 'bang_api_test';

}

class ApiLogTypes {

    const Daily = 'daily';
    const Monthly = 'monthly';

}

class ConfigRedis {

    const Host = 'localhost';
    const Port = 6379;

}
