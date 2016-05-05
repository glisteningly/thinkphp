<?php
namespace Home\Controller;

class PublicController extends \Think\Controller
{

    public function verify()
    {
        $Verify =     new \Think\Verify();
        // 设置验证码字符为纯数字
        $Verify->codeSet = '0123456789';
        $Verify->fontSize = 28;
        $Verify->length   = 4;
        $Verify->useCurve = false;
        $Verify->entry(1);
    }
}