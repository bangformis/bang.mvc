<?php

require_once 'System.php';

//Cookie::RemoveCookie('name1');
echo Cookie::HasCookie('name1') . "<br />";
Cookie::SetCookie('name1', 'test22');
echo Cookie::GetCookie('name1') . "<br />";
