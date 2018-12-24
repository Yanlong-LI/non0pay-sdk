<?php
/**
 * Created by PhpStorm.
 * User: Yanlongli
 * Date: 2018/4/4 0004
 * Time: 下午 2:32
 * APPLICATION:
 */

namespace Non0\Pay\Service;


use Non0\Pay\Kernel;
use Non0\Pay\Support\Curl;
use Non0\Pay\Support\Log;

class BaseService
{
    /**
     * @param null $data
     * @param bool $Encode
     * @param string $method
     * @param string $extendUrl
     * @return mixed
     */
    protected static function request($extendUrl = '', $data = null, $method = '')
    {
        if (!empty($data)) {
            $data['sign'] = Kernel::getApi()->sign2($data);
//            ksort($data);//对数组按照key重新排序，兼容不按顺序写入数据
        }

        Log::debug('url：' . Kernel::getApi()->interfaceAddress, ['result' => $data]);

        //如传递了请求方式，怎使用，否则用配置方式
        $method = $method ? $method : Kernel::getApi()->method;

        //如配置请求方式无效，则根据data是否有数据选定请求方式，无get，有post
        if (!$method) {
            $method = is_null($data) ? 'get' : 'post';
        }

        //发起请求
        $result = Curl::execute(Kernel::getApi()->interfaceAddress . $extendUrl, $method, $data);
        Log::debug('url：' . Kernel::getApi()->interfaceAddress, ['result' => $result]);

        //验证数据及签名

        $result = json_decode($result,true);
        if($result){
            $sign = $result['sign']??null;
            $result['verify'] = Kernel::getApi()->verify($result,$sign);
        }

        //json转数组
        return $result;
    }
}
