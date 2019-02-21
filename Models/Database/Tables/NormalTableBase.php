<?php

namespace Models\Database\Tables;

use Bang\Lib\MySqlDb;
use Bang\Lib\ORM;
use Bang\MVC\DbContext;
use Exception;
use Models\ErrorCode;

/**
 * @author Bang
 */
abstract class NormalTableBase {

    public abstract function GetTableName();

    public abstract function GetKeyColumn();

    public function Insert() {
        $tablename = $this->GetTableName();
        $params = MySqlDb::GetParamsByObject($this);
        DbContext::QuickInsert($tablename, $params);
    }

    /**
     * @return int Effect row count
     */
    public function Update() {
        $tablename = $this->GetTableName();
        $key = $this->GetKeyColumn();
        $params = MySqlDb::GetParamsByObject($this);
        unset($params[":{$key}"]);
        $where = "`{$key}`=:where_{$key}";
        $params[":where_{$key}"] = $this->{$key};
        $stem = DbContext::QuickUpdate($tablename, $where, $params);
        $result = $stem->rowCount();
        return $result;
    }

    public function Delete() {
        $tablename = $this->GetTableName();
        $key = $this->GetKeyColumn();
        $sql = "DELETE FROM `{$tablename}` WHERE `{$key}`=:{$key} LIMIT 1";
        $params = array(
            ":{$key}" => $this->{$key}
        );
        $stem = DbContext::Query($sql, $params);
        if ($stem->rowCount() === 0) {
            throw new Exception("Delete data[$this->{$key}] from table {$tablename} was fail!", ErrorCode::DatabaseError);
        }
    }

    public function Refresh() {
        $tablename = $this->GetTableName();
        $key = $this->GetKeyColumn();
        $sql = "SELECT * FROM `{$tablename}` WHERE `{$key}`=:{$key} LIMIT 1";
        $params = array(
            ":{$key}" => $this->{$key}
        );
        $stem = DbContext::Query($sql, $params);
        if ($stem->rowCount() === 0) {
            $sn = $this->{$key};
            throw new Exception("The data[{$sn}] in table {$tablename} was not found!", ErrorCode::NotFound);
        }
        $data = $stem->fetch(2);
        ORM::ArrayToObject($data, $this);
    }

}
