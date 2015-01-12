<?php

class Config {

    /**
     * @var string 網站跟目錄（相對位置）
     */
    public static $Root = "/";

    public static $Path = __DIR__;
    
    /**
     * @var string 網站名稱(會出現在Title 後至)
     */
    public static $SiteName = "AYA Safe API";

    //Memcached 伺服器設定
    const MemcachedServer = "localhost";
    const MemcachedServerPort = 11211;
    
    //資料庫各項連線設定
    const DbName = "bang.ayasafe";
    const DbHost = "localhost";
    const DbPort = "3306";
    const DbUser = "root";
    const DbPassword = "123456";
    
    //各項快取設定
    const BufferInsertCount = 10;
    
    //系統使用的目錄分隔符號
    const DirSplitor = "\\";
    
    
}
