<?php
namespace Home\Controller;

//use User\Api\UserApi;

//use Think\Controller;

class IndexController extends \Think\Controller
{
    public function index()
    {
        $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>', 'utf-8');
    }

    public function hello($name = 'thinkphp')
    {
        $this->assign('name', $name);
        $this->display();
    }

    private function hello3()
    {
        echo '这是private方法!';
    }

    public function getdata()
    {
        $Data = M('Data');// 实例化Data数据模型
        $result = $Data->find(3);
        $this->assign('result', $result);
        $this->display();
    }

    public function login($phone = '13900000000', $verify = null)
    {
        if (!check_verify($verify)) {
            $this->error('验证码输入错误！');
        }
        $this->assign('phone', $phone);
        $this->assign('verify', $verify);
        $this->display();

    }

    public function smstest()
    {
        $this->display();
    }
}