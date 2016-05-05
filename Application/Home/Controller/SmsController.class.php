<?php
namespace Home\Controller;

use Lib;

class SmsController extends \Think\Controller
{


    public function index()
    {
        $this->display();
    }

    public function sms()
    {
        if (IS_AJAX) {
            $mobile = I('post.mobile');
            $status = preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $mobile);
            if (!preg_match('/^(1[345678])[0-9]{9}$/', $mobile)) {
                $data['message'] = '手机号码填写有误';//提示语句
                $data['code'] = $status;//返回标识
            } else {
                $data = $this->send($mobile);
            }

            $data['data'] = $mobile;
            $this->ajaxReturn($data);
        } else {
            $this->error('非法提交');
        }

    }

    /**
     * 获取随机位数数字
     * @param  integer $len 长度
     * @return string
     */
    protected static function randString($len = 6)
    {
        $chars = str_repeat('0123456789', $len);
        $chars = str_shuffle($chars);
        $str = substr($chars, 0, $len);
        $_SESSION['sms_code'] = $str;//写入session
        $_SESSION['sms_send_time'] = time();//记录生成时间
        return $str;
    }

    private $sms = null;

    public function send($mobile = null)
    {

        $stringUtil = new \Org\Util\String();
        $this->sms = \Lib\SmsProxy::createInstance();

        $this->sms->setConf(C('SMS_ENTINFO_CONFIG'));

        $response = $this->sms->send($mobile, $stringUtil->randString(6, 1), 1);
        if (!$response) {
//            echo "send sms code failed!";
            $data['message'] = '发送失败';//提示语句
            $data['code'] = 1;//返回标识
        } else {
            $data['message'] = $response->message;
            $data['code'] = $response->code;
        }
        return $data;
    }

    public function verify()
    {
        $code = I("param.code");
        $mobile = I('param.mobile');
        if (!preg_match('/^1[\d]{10}$/', $mobile)){
            echo "手机号格式不正确！";
            exit;
        }
        $this->sms = \Lib\SmsProxy::createInstance();
        $res = $this->sms->chkSmsVerify($mobile,$code,1);
        if( $res ) {
            echo "Success!";
        } else {
            echo "Failed!";
        }
    }
}