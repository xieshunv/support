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
 * @date:       2020-10-24 12:43
 */

//设置时区
date_default_timezone_set("Asia/Shanghai");
//设置字符编码为utf-8
header("Content-Type: text/html;charset=utf-8");
//打开所有错误
error_reporting(E_ALL);
ini_set("display_errors","On");

require_once './vendor/autoload.php';

use xieshunv\support\Sign;

//秘钥
$key = "ALssQcALssQc";
//单例模式
$objSign = Sign::getInstance($key);
//参与签名的参数
$param = [
    'id'=>'123',
    'city'=>'beiJing',
    'name'=>'xieshunv',
    'amount'=>110.3
];
//签名
$singInfo = $objSign->build($param);

//$singInfo['amount'] = '0.01';

//验签 若修改参与签名的参数的，则验证失败
$ret = $objSign->checkSign($singInfo);

var_dump($ret);

