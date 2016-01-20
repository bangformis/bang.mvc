<?php

include 'System.php';
$route = new Route();
Request::GetGet($route);
$route->invoke();