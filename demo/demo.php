<?php

require_once '../vendor/autoload.php';

$config = require 'config-local.php';

$k = new \Non0\Pay\Kernel();
$k->init($config);

$result = \Non0\Pay\Service\Order::create('测试','这是一个测试订单',3,1,'','MWEB','127.0.0.1',['type'=>'order','type2'=>'充值']);
var_dump($result);
