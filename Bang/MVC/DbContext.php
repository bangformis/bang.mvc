<?php

/**
 * 資料庫類型容器基底
 * @author Bang
 */
class DbContext {

    /**
     * 實作單例連線
     * @var PDO 連線
     */
    private static $Connection = NULL;

    /**
     * 取得PDO連線
     * @return PDO 連線物件
     */
    public static function GetConnection() {
        if (is_null(DbContext::$Connection)) {
            $host = Config::DbHost;
            $name = Config::DbName;
            $pdo = new PDO("mysql:host=$host;dbname=$name;charset=utf8", Config::DbUser, Config::DbPassword);
            $pdo->exec("set names utf8");
            DbContext::$Connection = $pdo;
        }
        return DbContext::$Connection;
    }

    /**
     * 執行Query
     * @param string $sql Prepare SQL語法
     * @param array $params 傳入參數
     * @return PDOStatement 查詢結果
     */
    public static function Query($sql, $params) {
        $con = DbContext::GetConnection();
        $stem = $con->prepare($sql);
        $result = $stem->execute($params);
        if (!$result) {
            $str_params = json_encode($params);
            throw new Exception("Sql exception in:{$sql},params:{$str_params}");
        }
        return $stem;
    }

}
