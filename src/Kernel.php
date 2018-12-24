<?php

namespace Non0\Pay;

/**
 * Created by PhpStorm.
 * User: Yanlongli
 * Date: 2018年6月25日
 * Time: 上午 11:01
 * APPLICATION:非付支付SDK核心文件
 */

use Non0\Pay\Support\Log;


/**
 * Class Kernel
 * @package Non0\Pay
 */
class Kernel
{
    public static $lang;
    /**
     * @var Api
     */
    protected static $api = null;

    //配置文件路径
    protected $configPath = null;
    /**
     * @var array
     */
    private static $config = array();

    /**
     * 初始化配置信息
     * @param $config
     */
    public function init($config)
    {
        self::$config = $config;

        //初始化语言包  默认为中文
        static::$lang = require __DIR__ . "/lang/" . self::getConfig('language', 'zh-cn') . '.php';

        //初始化时间为 特定区域
        date_default_timezone_set(self::getConfig('timezone','Asia/Shanghai'));///::$config['timezone']);
        Log::debug('kernel.init start');
    }


    /**
     * 获取配置参数
     * 兼容 key.key
     * key. 获取key下的所有数据 value
     * @param $name
     * @param null $default
     * @param null $config
     * @return array|mixed|null
     */
    public static function getConfig($name = '', $default = null, $config = null)
    {
        if ($config == null) {
            $config = self::$config;
        }
        $name = explode('.', $name);
        if (count($name) == 1) {
            if (trim($name[0]) == '') return $config;
            return isset($config[$name[0]]) ? $config[$name[0]] : $default;
        } else {
            if (isset($config[$name[0]])) {
                $newname = $name[0];
                unset($name[0]);
                $name = implode('.', $name);
            }
            return self::getConfig($name, null, $config[$newname]);
        }
    }

    public static function setConfig($name, $defaultValue = null)
    {
        if (array_key_exists($name, static::$config)) {
            return static::$config[$name] = $defaultValue;
        }
        return $defaultValue;
    }

    /**
     * @return Api
     */
    public static function getApi()
    {
        if (static::$api == null) {
            static::$api = new Api(self::$config);
            Log::debug('kernel.getApi');
        }
        return static::$api;
    }

}
