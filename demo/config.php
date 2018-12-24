<?php
/**
 * Created by PhpStorm.
 * User: Yanlongli
 * Date: 2018/4/4 0004
 * Time: 下午 12:52
 * APPLICATION:信达付接口配置文件-本地
 */

//非付支付接口配置文件

return array(

    //支付接口地址（服务分配）
    'interfaceAddress' => '',

    //支付回调地址
    'callback'=>'',

    //提交方式：post
    'method' => 'post',

    //字符编码：统一采用UTF-8字符编码
    'character' => 'UTF-8',//未启用

    //数据格式 json xml
    'dataType'=>'json',

    'apiVersion'=>'1.0.0',

    //签名算法：RSA，后续兼容SHA1、SHA256、HMAC-SHA1  HMAC-SHA256 HMAC-MD5等
    'signature' => 'RSA',

    //提交信息签名或加密密钥
    'signatureKey' => '',
    //此处为服务提供方 提供返回信息签名验证或解密字段
    'signaturePublicKey'=>'',
//    'signaturePublicKey'=>'',

    //签名要求：请求和接收数据均需要校验签

    //机构号（富友分配）
    'organizationNumber' => '',

    //商户号
    'merchantNumber' => '',

    //语言包
    'language' => 'zh-cn',

    //时区  亚洲/上海
    'timezone'=>'Asia/Shanghai',

    //日志
    'log' => array(
        'class' => 'Non0\Pay\Support\Logger',
        'name' => 'non0.pay',
        'level' => Monolog\Logger::DEBUG,//日志显示级别
        'file' => './pay.log',
    ),

);
