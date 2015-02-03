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
    public static $SiteName = "Bang MVC";

    //Memcached 伺服器設定
    const MemcachedServer = "localhost";
    const MemcachedServerPort = 11211;
    //資料庫各項連線設定
    const DbName = "bang.ayasafe.new";
    const DbHost = "localhost";
    const DbPort = "3306";
    const DbUser = "root";
    const DbPassword = "123456";
    //各項快取設定
    const BufferInsertCount = 10;
    //系統使用的目錄分隔符號
    const DirSplitor = "\\";
    
    //是否為啟用版本 啟用版本將會不檢視錯誤訊息並記錄至資料庫中
    const IsReleaseMode = false;

}

/**
 * Cassandra 設定
 */
class CassandraConfig {

    /**
     * 連接位置
     */
    public static $Hosts = array(
        '107.167.182.168:9042'
    );

    /**
     * 預設 Keyspace
     */
    const DefaultKeyspace = "casino_ayasafe";

}
