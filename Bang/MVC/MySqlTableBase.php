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
    public function GetList() {
        $className = get_class($this);
        $sql = "SELECT * FROM `$className`";
        $db = DbContext::GetConnection();
        return ORM::TwoDArrayToObjects($db->query($sql), $className);
    }

    /**
     * 將目前資料加入資料庫中
     * @return bool 執行結果
     */
    public function Insert() {
        $tableName = get_class($this);
        $objArray = ORM::ObjectToArray($this);
        $sql1 = "INSERT INTO `$tableName` (";
        $sql2 = "VALUES (";

        //INSERT INTO `operator` (`id`, `password`, `name`, `permission`) VALUES ('asdf', 'asdf', 'asdf', '9')

        $index = 0;
        foreach ($objArray as $name => $value) {
            if ($index > 0) {
                $sql1 .= ",";
                $sql2 .= ",";
            }
            $sql1 .= "`$name`";
            $sql2 .= "'$value'";
            $index++;
        }
        $sql1 .= " ) ";
        $sql2 .= " ) ;";
        $sql = $sql1 . $sql2;
        $connect = DbContext::GetConnection();
        return $connect->exec($sql);
    }
}
