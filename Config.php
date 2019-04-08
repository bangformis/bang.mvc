<?php

class Config {

    /**
     * @var string з¶Ізи·џз›®„пёедЅЌзЅ®пј
     */
    public static $Root = "/bang.mvc/";
    public static $Path = __DIR__;

    /**
     * @var string з¶ІзЌзЁ±(ѓе‡єѕењЁTitle еѕЊи‡і)
     */
    public static $SiteName = "Bang MVC API";

    //иі‡жеє«е…йЂиЁ­е
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
    const LogError = true;
    const LogRequest = true;
    const Key = 'bang_api_test';

}
