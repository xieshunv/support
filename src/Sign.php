<?php
/**
 * ==============================================
 * 签名 验签
 * ----------------------------------------------
 * PHP version 7 灵析
 * ==============================================
 * @category：  PHP
 * @author：    xieshunv <xieshun@lingxi360.cn>
 * @copyright： @2020 http://www.lingxi360.cn/
 * @version：   v1.0.0
 * @date:       2020-11-08 22:01
 */

namespace xieshunv\support;

use xieshunv\support\Helper;

class Sign
{
    /**
     * 签名秘钥
     * @var string
     */
    private $secret = "qIek5cWmvf#Ef6eAPqg5k3r&B";

    /**
     * @var 保存全局实例
     */
    private static $instance;

    /**
     * 私有化构造函数，防止外界实例化对象
     * Convertip constructor.
     */
    private function __construct($secret = null)
    {
        if ($secret) {
            $this->secret = $secret;
        }
    }

    /**
     * 私有化克隆函数，防止外界克隆对象
     */
    private function __clone()
    {
        die('Clone is not allowed.' . E_USER_ERROR);
    }

    /**
     * 单例访问统一入口
     * @return
     */
    public static function getInstance($secret = null)
    {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self($secret = null);
        }
        return self::$instance;
    }

    /**
     * 签名
     * @param array $param
     * @return array
     */
    public function build($param = [])
    {
        if (empty($param)) {
            return [];
        }

        $param['rand_str'] = Helper::getRandStr(6);
        $param['time'] = time();

        $signText = $this->getSortParams($param);
        $sign = md5($signText . $this->secret);

        $param['sign'] = $sign;

        return $param;
    }

    /**
     * 签名参数排序
     * @param array $param
     * @return string
     */
    public function getSortParams($param = [])
    {
        unset($param['sign']);
        ksort($param);
        $signstr = '';
        if (is_array($param)) {
            foreach ($param as $key => $value) {
                if ($value == '') {
                    continue;
                }
                $signstr .= $key . '=' . $value . '&';
            }
            $signstr = rtrim($signstr, '&');
        }
        return $signstr;
    }

    /**
     * 验证签名
     * @return bool
     */
    public function checkSign($param = [])
    {
        if (empty($param)) {
            return false;
        }
        $urlSign = isset($param['sign']) ? $param['sign'] : '';

        $str = $this->getSortParams($param);
        $sign = md5($str . $this->secret);
        if ($sign == $urlSign) {
            return true;
        }

        return false;
    }

}