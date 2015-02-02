<?php

/**
 * MySql資料庫資料表對應Model基底(ORM)
 * @author Bang
 */
class MySqlTableBase {

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
                    if ($without == 'NULL') {
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
                $values[":$name"] = $value;
                $index++;
            }
            $sql = $cache->data;
        }

        $bag = new SqlBag($sql, $values);
        return $bag;
    }

    /**
     * 將目前資料加入資料庫中
     * @param array $without_keys 不打算Insert的欄位
     * @return int 執行結果或最後一次InsertID
     */
    public function Insert($without_keys = NULL) {
        $bag = $this->GetInsertSqlBag($without_keys);
        $connect = DbContext::GetConnection();
       
        $stem = $connect->prepare($bag->PrepareSql);
        $stem->execute($bag->KeyValues);
        return $connect->lastInsertId();
    }

}
