<?php

require_once '../vendor/autoload.php';

$config = require 'config-local.php';

$k = new \Non0\Pay\Kernel();
$k->init($config);

$result = \Non0\Pay\Service\Order::create('测试','这是一个测试订单',1,1,'','MWEB','127.0.0.1');
var_dump($result);
