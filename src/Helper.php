<?php
/**
 * ==============================================
 * 通用函数
 * ----------------------------------------------
 * PHP version 7 灵析
 * ==============================================
 * @category：  PHP
 * @author：    xieshunv <xieshun@lingxi360.cn>
 * @copyright： @2020 http://www.lingxi360.cn/
 * @version：   v1.0.0
 * @date:       2020-11-08 22:03
 */

namespace xieshunv\support;

class Helper
{
    /**
     * 生成密码（明文,密文）
     * @return array
     */
    public static function getPassWord($salt = null)
    {
        $passWrod = self::getRandStr();

        if ($salt) {
            $ciphertext = md5($passWrod . $salt);
        } else {
            $ciphertext = md5($passWrod);
        }

        return [
            'pwd' => $passWrod,
            'ciphertext' => $ciphertext
        ];
    }

    /**
     * 随检字符串
     * @param int $length
     * @return string
     */
    public static function getRandStr($length = 10)
    {
        //字符组合
        $str = 'efgIJkmnovwxyzABCDE&#FGHKLMpqrstuNOPabcdQRSTUVWXYZ23456789()*@!';
        $len = strlen($str) - 1;
        $randstr = '';
        for ($i = 0; $i < $length; $i++) {
            $num = mt_rand(0, $len);
            $randstr .= $str[$num];
        }
        return $randstr;
    }

}