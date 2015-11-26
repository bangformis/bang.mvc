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

    /**
     * @param string $tablename
     * @param string $params (参数以where开头将不会被Update,只会带入where语法中)
     * @return string last_insert_id
     */
    public static function QuickInsert($tablename, $params) {
        $keys = array();
        foreach ($params as $key => $value) {
            $keys[] = String::Replace($key, ':', '');
        }

        $fields = "";
        $values = "";
        foreach ($keys as $key => $value) {
            if ($key > 0) {
                $fields .= ",";
                $values .= ",";
            }
            $fields .= "`{$value}`";
            $values .= " :{$value}";
        }

        $sql = "INSERT INTO `{$tablename}`($fields) VALUES ($values) ;";
        return DbContext::Insert($sql, $params);
    }

    /**
     * 
     * @param string $tablename
     * @param string $where
     * @param string $params (参数以where开头将不会被Update,只会带入where语法中)
     * @return PDOStatement
     */
    public static function QuickUpdate($tablename, $where, $params) {
        $keys = array();
        foreach ($params as $key => $value) {
            $keys[] = String::Replace($key, ':', '');
        }

        $set_sql = "";
        $count = 0;
        foreach ($keys as $value) {
            if (String::StartsWith($value, 'where')) {
                continue;
            }
            if ($count > 0) {
                $set_sql .= ",";
            }
            $set_sql .= "`{$value}`=:{$value}";
            $count++;
        }

        $sql = "UPDATE `{$tablename}` SET {$set_sql} WHERE ({$where})";
        return DbContext::Query($sql, $params);
    }

}
