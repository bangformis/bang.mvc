<?php

namespace Bang\Lib;

/**
 * @author Bang
 */
class CassandraDb {

    /**
     * @param string $Hosts ex: 10.1.1.1,10.1.1.2, ...
     * @param string $Keyspace
     * @param string $Username
     * @param string $Password
     */
    function __construct($Hosts, $Keyspace, $Username = '', $Password = '') {
        $this->Hosts = $Hosts;
        $this->Keyspace = $Keyspace;
        $builder = \Cassandra::cluster();
        $this->Builder = $builder;

        if (String::IsNotNullOrSpace($Username) && String::IsNotNullOrSpace($Password)) {
            $this->Username = $Username;
            $this->Password = $Password;
            $builder->withCredentials($Username, $Password);
        }
        $builder->withContactPoints($Hosts);
        $builder->withConnectTimeout(10);
        $cluster = $builder->build();
        $this->Cluster = $cluster;
        $session = $cluster->connect($Keyspace);
        $this->Session = $session;
    }

    public $Keyspace;
    private $Hosts;
    private $Username;
    private $Password;

    /**
     * @var \Cassandra\Session 
     */
    private $Session;

    /**
     * @var \Cassandra\Cluster
     */
    private $Cluster;

    /**
     * @var \Cassandra\Cluster\Builder 
     */
    private $Builder;

    /**
     * @param string $cql ex:select * from tb where id = ?;
     * @param array $params array( 'bang' )
     * @return \Cassandra\Rows
     */
    public function Query($cql, $params = array()) {
        $session = $this->Session;
        $stem = $session->prepare($cql);
        $options = new \Cassandra\ExecutionOptions(array(
            'arguments' => $params
        ));
        $result = $session->execute($stem, $options);
        return $result;
    }

    public static function Format($current_array) {
        $result = array();
        foreach ($current_array as $key => $value) {
            if (is_object($value)) {
                if (is_a($value, "Cassandra\\Timeuuid")) {
                    $result[$key] = $value->uuid();
                } else if (is_a($value, "Cassandra\\Float")) {
                    $result[$key] = round($value->value(), 4);
                } else if (is_a($value, "Cassandra\\Timestamp")) {
                    $result[$key] = $value->time();
                } else if (is_a($value, "Cassandra\\Bigint")) {
                    $result[$key] = $value->value();
                } else {
                    $result[$key] = $value;
                }
            } else {
                $result[$key] = $value;
            }
        }
        return $result;
    }

    public static function FormatRows(\Cassandra\Rows $rows) {
        $results = array();
        while ($rows->valid()) {
            $results[] = self::Format($rows->current());
            $rows->next();
        }
        return $results;
    }

}
