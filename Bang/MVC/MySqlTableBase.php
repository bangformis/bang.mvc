<?php

/**
 * MySql資料庫資料表對應Model基底(ORM)
 * @author Bang
 */
class MySqlTableBase {

    public function GetList() {
        $className = get_class($this);
        $sql = "SELECT * FROM `$className`";
        $db = DbContext::GetConnection();
        return ORM::TwoDArrayToObjects($db->query($sql), $className);
    }

}
