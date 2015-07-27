<?php

/**
 * MySql資料庫資料表對應Model基底(ORM)
 * @author Bang
 */
abstract class MySqlTable {

    /**
     * 取得單一筆資料
     * @param MySqlTable $class_object 取得資料表的Model空物件
     * @param string $append_sql 選表後可帶入的條件
     * @param array $params 會帶入的Parameters
     * @return mixed 回傳該物件類型資料
     */
    public static function GetSingle($class_name, $append_sql, $params = NULL) {
        $sql = "SELECT * FROM `$class_name` $append_sql";
        $stem = DbContext::Query($sql, $params);
        $class_object = $stem->fetchObject($class_name);
        return $class_object;
    }

    /**
     * 取得Table中所有資料
     * @return array 表內所有資料
     */
    public function GetList($sql = NULL) {
        $className = get_class($this);
        if (is_null($sql)) {
            $sql = "SELECT * FROM `$className`";
        }
        $db = DbContext::GetConnection();
        return ORM::TwoDArrayToObjects($db->query($sql), $className);
    }

    /**
     * 取得Table中所有資料
     * @param string $key_property_name 作為KEY的欄位名稱
     * @param string $sql SQL查詢語法，預設為Select 全資料
     * @return array 表內所有資料
     */
    public function GetKeyList($key_property_name, $sql = NULL) {
        $className = get_class($this);
        if (is_null($sql)) {
            $sql = "SELECT * FROM `$className`";
        }
        $db = DbContext::GetConnection();
        return ORM::TwoDArrayToObjectsKeyArray($db->query($sql), $className, $key_property_name);
    }

    /**
     * 將目前資料加入資料庫中
     * @param array $without_keys 不打算Insert的欄位
     * @return int 執行結果或最後一次InsertID
     */
    protected function InsertData($without_keys = array()) {
        
        $bag = $this->GetInsertSqlBag($without_keys);
        $connect = DbContext::GetConnection();
        $stem = $connect->prepare($bag->PrepareSql);
        $result = $stem->execute($bag->KeyValues);
        return $connect->lastInsertId();
    }

    /**
     * 將目前資料更新至資料庫
     * @param string $where_string
     * @param array $where_params
     * @param array $without_keys
     */
    protected function UpdateData($where_string, $where_params, $without_keys = NULL) {
        $bag = $this->GetUpdateSqlBag($where_string, $where_params, $without_keys);
        $connect = DbContext::GetConnection();
        $stem = $connect->prepare($bag->PrepareSql);
        $stem->execute($bag->KeyValues);
    }

    /**
     * 刪除目前物件資料
     * @param string $where_string
     * @param array $where_params
     */
    protected function DeleteData($where_string, $where_params) {
        $className = get_class($this);
        $sql = "DELETE FROM `$className` WHERE ($where_string)";
        DbContext::Query($sql, $where_params);
    }

    /**
     * 取得Insert用的SqlBag物件
     * @param array $without_keys 不打算Insert的欄位
     * @return \SqlBag
     */
    private function GetInsertSqlBag($without_keys = NULL) {
        $tableName = get_class($this);
        $key = "__PreapreInsertSQL_$tableName";
        $cache = Cache::Get($key);

        if ((!$cache) || $cache->IsTimeout()) {
            $objArray = ORM::ObjectToArray($this);
            $sql1 = "INSERT INTO `$tableName` (";
            $sql2 = "VALUES (";
            $index = 0;
            $values = array();
            foreach ($objArray as $name => $value) {
                if ((!is_null($without_keys)) && isset($without_keys[$name])) {
                    $without = $without_keys[$name];
                    if ($without === TRUE) {
                        continue;
                    } else {
                        $value = $without;
                    }
                }
                if ($index > 0) {
                    $sql1 .= ",";
                    $sql2 .= ",";
                }
                $sql1 .= "`$name`";
                $sql2 .= ":$name";

                $values[":$name"] = $value;

                $index++;
            }
            $sql1 .= " ) ";
            $sql2 .= " ) ;";
            $sql = $sql1 . $sql2;
            Cache::Set($key, $sql, 1800);
        } else {
            $objArray = ORM::ObjectToArray($this);
            $index = 0;
            $values = array();
            foreach ($objArray as $name => $value) {
                if ((!is_null($without_keys)) && isset($without_keys[$name])) {
                    $without = $without_keys[$name];
                    if ($without === TRUE) {
                        continue;
                    }
                }
                $values[":$name"] = $value;
                $index++;
            }
            $sql = $cache->data;
        }

        $bag = new SqlBag($sql, $values);
        return $bag;
    }

    private function GetUpdateSqlBag($where_string, $where_params, $without_keys = NULL) {
        $tableName = get_class($this);
        $key = "__PreapreUpdateSQL_$tableName";
        $cache = Cache::Get($key);

        if ((!$cache) || $cache->IsTimeout()) {
            $objArray = ORM::ObjectToArray($this);
            $sql1 = "UPDATE `$tableName` SET ";
            $index = 0;
            $values = array();
            foreach ($objArray as $name => $value) {
                if ((!is_null($without_keys)) && isset($without_keys[$name])) {
                    $without = $without_keys[$name];
                    if ($without === TRUE) {
                        continue;
                    } else {
                        $value = $without;
                    }
                }
                if ($index > 0) {
                    $sql1 .= ",";
                }
                $sql1 .= "`$name`=:$name";
                $values[":$name"] = $value;
                $index++;
            }

            $sql1 .= " WHERE ($where_string)";
            $sql = $sql1;
            Cache::Set($key, $sql, 1800);
        } else {
            $objArray = ORM::ObjectToArray($this);

            $index = 0;
            $values = array();
            foreach ($objArray as $name => $value) {
                if ((!is_null($without_keys)) && isset($without_keys[$name])) {
                    $without = $without_keys[$name];
                    if ($without === TRUE) {
                        continue;
                    }
                }
                $values[":$name"] = $value;
                $index++;
            }
            $sql = $cache->data;
        }
        if (!is_null($where_params) && is_array($where_params)) {
            $values = $values + $where_params;
        }
        $bag = new SqlBag($sql, $values);
        return $bag;
    }

    public abstract function Insert();

    public abstract function Update();

    public abstract function Delete();
}
