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
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
    public static function Query($sql, $params = array()) {
        $con = DbContext::GetConnection();
        $stem = $con->prepare($sql);
        $result = $stem->execute($params);
        return $stem;
    }

    /**
     * 執行Insert Query
     * @param string $sql Prepare SQL語法
     * @param array $params 傳入參數
     * @return string Insert后LastId
     */
    public static function Insert($sql, $params = array()) {
        $con = DbContext::GetConnection();
        $stem = $con->prepare($sql);
        $stem->execute($params);
        return $con->lastInsertId();
    }

    /**
     * 判斷資料表是否存在
     * @param string $table_name
     * @return boolean 判斷結果
     */
    public static function IsTableExist($table_name) {
        $sql = "show tables like '{$table_name}'";
        $query_result = DbContext::Query($sql, array());
        $result = $query_result->fetchAll(PDO::FETCH_ASSOC);
        $row_count = $query_result->rowCount();
        return $row_count > 0;
    }

    public static function StartTransaction() {
        DbContext::Query('START TRANSACTION;');
    }

    public static function Commit() {
        DbContext::Query('COMMIT;');
    }

}
