<?php

require_once 'System.php';

$test =15564453;

$str_36 = Math::To36Carry($test);
$str_10 = Math::To10CarryFrom36($str_36);
$file = new TextFile($path);
echo $str_36 . '=' . $str_10;