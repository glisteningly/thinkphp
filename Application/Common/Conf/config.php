<?php
return array(
	//'配置项'=>'配置值'
    //注册新的命名空间，存放自定义类库
    'AUTOLOAD_NAMESPACE' => array(
        'Lib'     => APP_PATH.'/Common/Lib',
    ),

    //漫道科技短信验证码配置
    'SMS_ENTINFO_CONFIG' => array(
        'smsType'   => 'smsentinfo',
        'sn' => 'SDK-AMD-010-01655',
        'password' => '051325',
        'ext' => '',
        'rrid' => '',
        'stime' => '',
        'appName' => '贝易达'
    ),
);