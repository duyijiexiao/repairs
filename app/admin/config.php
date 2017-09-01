<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// $Id$

return [
    //自定义路径
    'css_path'   => '../admin_style/',
    'version'=>'0.1.0', //版本号
    'product_name' => 'DoMall', //产品名称
    'index_theme_wap'  =>'wap',//前台主题
    'index_theme_pc'   =>'pc',//前台主题
    'index_view_suffix'=>'.html',
    'index_view_depr'=>'_',
    'seller_view_suffix'=>'.html',
    'seller_view_depr'=>'_',
    'admin_theme'=>'admin',//后台主题
    'admin_view_suffix'=>'.html',
    'admin_view_depr'=>'_',
    'admin_templates' => '/templates/admin',
    'index_templates' => '/templates/index',
    'seller_templates' => '/templates/seller',
    'web_url'=>'#',
    'base_url'  =>  '',
    'url_route_on' => true,
    'FILE_UPLOAD_TYPE'      =>  'Local',    // 文件上传方式
//    'log'          => [
//        'type'             => 'trace', // 支持 socket trace file
//        // 以下为socket类型配置
//        'host'             => '111.202.76.133',
//        //日志强制记录到配置的client_id
//        'force_client_ids' => [],
//        //限制允许读取日志的client_id
//        'allow_client_ids' => [],
//    ],
    'var_page' => 'p',
    'admin_page_rows' => 10,

    'paginate'               => [
        'type'      => 'bootstrap',
        'var_page'  => 'page',
        'list_rows' => 15,
    ],
    'captcha'  => [
        // 验证码字符集合
        'codeSet'  => '2345678abcdefhijkmnpqrstuvwxyzABCDEFGHJKLMNPQRTUVWXY',
        // 验证码字体大小(px)
        'fontSize' => 18,
        // 是否画混淆曲线
        'useCurve' => false,
        // 验证码图片高度
        'imageH'   => 35,
        // 验证码图片宽度
        'imageW'   => 130,
        // 验证码位数
        'length'   => 4,
        // 验证成功后是否重置
        'reset'    => true
    ],

    // +----------------------------------------------------------------------
    // | 微信配置
    // +----------------------------------------------------------------------
    'weChat'                =>  [
        "debug"         =>  true,
        "app_id"        =>  'xxxx',
        'secret'        =>  'xxxxx',
        'merchant_id'   =>  'xxxxx',
        'key'           =>  'xxxxx',
        'cert_path'     =>  'http://xxx/cert/apiclient_cert.pem',
        'key_path'      =>  'http://xxx/cert/apiclient_key.pem',
    ],

    // +----------------------------------------------------------------------
    // | 支付宝配置
    // +----------------------------------------------------------------------
    'aliPay'                =>  [
        //  合作身份者ID，签约账号，以2088开头由16位纯数字组成的字符串，查看地址：https://b.alipay.com/order/pidAndKey.htm
        "partner"           =>  "2088221292484013",
        //  收款支付宝账号，以2088开头由16位纯数字组成的字符串，一般情况下收款账号就是签约账号
        "seller_id"         =>  '2088221292484013',
        //  MD5密钥，安全检验码，由数字和字母组成的32位字符串，查看地址：https://b.alipay.com/order/pidAndKey.htm
        'key'               =>  'bj0wti49tkl532sv64sq6adkauinu5us',
        //  服务器异步通知页面路径  需http://格式的完整路径，不能加?id=123这类自定义参数，必须外网可以正常访问
        'notify_url'        =>  "http://商户网址/create_direct_pay_by_user-PHP-UTF-8/notify_url.php",
        //  签名方式 RSA / MD5
        'sign_type'         =>  strtoupper('RSA'),
        //  字符编码格式 目前支持 gbk 或 utf-8
        'input_charset'     =>  trim(strtolower(('utf-8'))),
        //  ca证书路径地址，用于curl中ssl校验 ( 请保证cacert.pem文件在当前文件夹目录中 )
        'cacert'            =>  getcwd().'\\cacert.pem',
        //  访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
        'transport'         =>  'http',
        //  支付类型 ，无需修改
        'payment_type'      =>  1,
        //  产品类型，无需修改
        'service'           =>  "create_direct_pay_by_user",
        //  商户的私钥,此处填写原始私钥去头去尾，RSA公私钥生成：https://doc.open.alipay.com/doc2/detail.htm?spm=a219a.7629140.0.0.nBDxfy&treeId=58&articleId=103242&docType=1
        'private_key'       =>  'MIICXgIBAAKBgQDIxXX6eDZA8nbrrZ2RO0RnlXBTI2r4S/hJsO4y5eV+iprfqUoJ
uU6PKrqin18XNjeEOW3WYelaJPoiH/vm1WF+qXxTB4C9V3nd2CqsBYkWej85sPCz
G3eAlaLiF+bFRBn75+GNil3Qm9RtJBIMOWbx4xdarORbOg+47ZSndqZP+QIDAQAB
AoGBAK4K3tcd1oo+pfBwNKNtaUMSPKkVjulnkfjvs83TlTo5FUDGFDSRuxRIyjmn
Rlts2Ht6/UhW4F8QpvVmHIxidXw5z5ghqWGrlAdbQyVp1Hd6nnnwX7zkduYPHGbW
TRWkkrBBU6y9T7QxDy2v4YmEqjL/6Ga6TC5wOC5oreN1myoBAkEA8OBrbYyVSdJd
g7fw3zgdSQGAWyS5+wIAD0S4qmTfhiE2/Qv8byRNa6NC8omVltN6u/uUZ5jOWX4Y
Lk1xDnij8QJBANVgbv6mJmim0je9+s6sYxbvTCYUJ67MXjvFnOXNZtfV0PUgYGsI
1wQgFVfyS9E5b23I4vipE00U7G122ayD1IkCQFlXpAD6B9VdxXm5nAnvUk1l1Sn5
MVI8p7ECGEx7Jb0mTLMG4xaGLIEkCQzUoztSLU/UPHNAZikjb+ycpLZtYMECQQCL
hzatkCpXjpayWqmyEent6mcKE23rkLoiLdOuNcWFZ8zvLc++zhYEHZK3YrqPQxaJ
XK6G2dDEO+Vqoygt9jq5AkEA3giaIXY1YAkFD5VOJc6H5ECfD9X9ZlFTgFeEeki4
KkVpX8oQGvzAvMXuM4fywblr9sWzgJlCc+niANIDjvUHpg==',
        //  支付宝的公钥，查看地址：https://b.alipay.com/order/pidAndKey.htm
        'alipay_public_key' =>  'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC4Ye30HP9LwnpS/rdquydO2X19
mYXdpd67PiH5 mhbel/ZgAgoUjPQNiH/6k0IIGJW6TQhqg8cART1w93RnGDbMwcU
+tF0egvk1qTDRSMzRe6EkigSQ dS4AWokDlwHT+8u9sTxQIhf3bF01yXLBC+Ahu0
6CI1LX+XL/vmHoc2pPbQIDAQAB',
        //  ↓↓↓↓↓↓↓↓↓↓ 请在这里配置防钓鱼信息，如果没开通防钓鱼功能，为空即可 ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
        'anti_phishing_key' =>  '', // 防钓鱼时间戳  若要使用请调用类文件submit中的query_timestamp函数
        'exter_invoke_ip'   =>  '', // 客户端的IP地址 非局域网的外网IP地址，如：221.0.0.1
    ],

];

