<?php
require_once 'System.php';
header('Content-Type: text/html; charset=utf-8');
$param = array(
    'id' => 'pg',
    'pwd' => md5('kevin123'),
);

$result = Bang\Lib\Net::HttpPOST('http://202.153.168.85/ExtApi/BackendExtLogin.php', $param);
var_dump($admin=json_decode($result,true));

$param = array(
    'c' => 'dep',
    'memberid' => '',
    'accurate' => '1',
    'cftype' => '',
    'ym' => '2017-03',
    'from' => '2017-03-27',
    'fromday' => 27,
    'fromhour' => 0,
    'endday' => 27,
    'endhour' => 23,
    'tmtype' => 'acc', //add
    'page' => 1,
    'batch_output' => 1,
    'admin_id'=>$admin['Value']['id'],
    'admin_ticket'=>$admin['Value']['ticket'],
);
$result = Bang\Lib\Net::HttpPOST('http://202.153.168.85/Output_MoneySummaryRecord.php', $param);

var_dump(json_decode($result));