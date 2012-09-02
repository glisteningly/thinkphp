<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2012 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// $Id: WriteHtmlCacheBehavior.class.php 1090 2012-08-23 08:33:46Z luofei614@126.com $
defined('THINK_PATH') or exit();
/**
 +------------------------------------------------------------------------------
 * 系统行为扩展 静态缓存写入
 * 增加配置参数如下：
 +------------------------------------------------------------------------------
 */
class WriteHtmlCacheBehavior extends Behavior {

    // 行为扩展的执行入口必须是run
    public function run(&$content){
        if(C('HTML_CACHE_ON') && defined('HTML_FILE_NAME'))  {
            //静态文件写入
            // 如果开启HTML功能 检查并重写HTML文件
            // 没有模版的操作不生成静态文件
            //[sae] 生成静态缓存
            $kv = Think::instance('SaeKVClient');
            if (!$kv->init())
                halt('您没有初始化KVDB，请在SAE平台进行初始化');
            if(APP_DEBUG) trace(HTML_FILE_NAME,'静态缓存','SAE');
            $kv->set(HTML_FILE_NAME,time().$content);
        }
    }
}