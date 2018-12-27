<?php
/**
 * Created by PhpStorm.
 * User: Yanlongli
 * Date: 2018/12/24
 * Time: 15:00
 */

namespace Non0\Pay\Service;


use Non0\Pay\Kernel;

class Order extends BaseService
{
    public static function create($title, $detail, $out_trade_no, $total_fee, $limit_pay, $trade_type, $spbill_create_ip)
    {
        $data = [];

        $data['mch_id'] = Kernel::getApi()->merchantNumber;//商户号
//        $data['organization_number'] = Kernel::getApi()->organizationNumber;//机构号
        $data['nonce_str'] = md5(uniqid());//随机字符串
        $data['body'] = $title;//订单标题
//        $data['detail'] = $detail;//订单描述
        $data['out_trade_no'] = $out_trade_no;//商户订单号
        $data['total_fee'] = $total_fee;//交易金额
        $data['limit_pay'] = $limit_pay;//选择支付方式
        $data['trade_type'] = $trade_type;//选择交易方式
        $data['spbill_create_ip'] = $spbill_create_ip;//客户IP
        $data['notify_url'] = Kernel::getConfig('callback');//支付成功回调地址


        return parent::request('/pay/unifiedOrder.pay', $data);
    }

    public static function query($out_trade_no)
    {
        $data = [];
        $data['mch_id'] = Kernel::getApi()->merchantNumber;//商户号
        $data['nonce_str'] = md5(uniqid());//随机字符串
        $data['out_trade_no'] = $out_trade_no;
        return self::request('/pay/query_order.pay');
    }

    public static function refund($out_trade_no, $out_refund_no, $refund_fee)
    {
        $data = [];
        $data['mch_id'] = Kernel::getApi()->merchantNumber;//商户号
        $data['nonce_str'] = md5(uniqid());//随机字符串
        $data['out_refund_no'] = $out_refund_no;//退款单号
        $data['out_trade_no'] = $out_trade_no;//交易单号
        $data['refund_fee'] = $refund_fee;//退款金额
        return self::request('/pay/refund.pay');
    }
}
