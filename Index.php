<?php

include 'System.php';

Request::GetGet($route = new Route());
$route->invoke();


