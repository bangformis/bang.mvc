<?php

require_once 'System.php';

//Appstore::Set('test1', 1234*5);
//echo Appstore::Get('test1');
//var_dump(BangSystem::GetAutoIncludes());

error_log::AddToDatabase(
    error_log::CreateInstance('test content', 'test.php', 1, 'message')
);
