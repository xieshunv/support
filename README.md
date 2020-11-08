# support
sign  verify Basic components helper

## composer require xieshunv/support
    <?php
        use xieshunv\support\Sign;
        class test
        {
            public function __construct()
            {
            }
            
            /**
             * @param $ip
             */
            public function setSign($param = [])
            {
                //秘钥
                $key = "ALssQcALssQc";
                //单例模式
                $objSign = Sign::getInstance($key);
                //参与签名的参数
                $param = [
                    "id"=>"123",
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
            }
        }
