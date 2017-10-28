<?php

require 'api.php';

$api = new api("token");

$r = $api->getMultipleGroupsInfo([1,2,3,4,5,6,7,8,9,10], ['cover']);

echo $r;