<?php

require_once Path::Content("Bang/Cassandra/Cassandra.php");

/**
 * Cassandra 資料庫連結
 */
class CassandraDb {

    function __construct() {
        $this->connection = new Cassandra\Connection(CassandraConfig::$Hosts, CassandraConfig::DefaultKeyspace);
    }

    private $connection;

    /**
     * @var CassandraDb
     */
    private static $CurrentConnection = NULL;

    /**
     * CQL查詢語法（多筆資料）
     * @param string $cql 
     * @return Cassandra\Rows
     */
    public static function Query($cql) {
        if (is_null(CassandraDb::$CurrentConnection)) {
            CassandraDb::$CurrentConnection = new CassandraDb();
        }
        return CassandraDb::$CurrentConnection->connection->query($cql);
    }

    /**
     * CQL查詢語法（單筆資料）
     * @param string $cql 
     * @return Cassandra\Rows
     */
    public static function QuerySingle($cql) {
        $rows = CassandraDb::Query($cql);
        return $row = $rows->current();
    }

}
