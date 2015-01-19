<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2015 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
namespace Think;      
/**
 * ThinkPHP 普通模式定义
 */

// 加载框架底层语言包
Lang::set(include THINK_PATH.'Lang/'.strtolower(Config::get('default_lang')).EXT);


// 初始化操作可以在应用的公共文件中处理 下面只是示例
//---------------------------------------------------
// 日志初始化
Log::init(['type'=>'File','log_path'=> LOG_PATH]);

// 缓存初始化
Cache::connect(['type'=>'File','temp'=> CACHE_PATH]);
//------------------------------------------------------

// 启动session
if(!IS_CLI) {
    Session::init(['prefix'=>'think','auto_start'=>true]);
}
if(is_file(APP_PATH.'build.php')) { // 自动化创建脚本
    Create::build(include APP_PATH.'build.php');
}

return [
    // 配置文件
    'config'    =>  [
        'app_debug'             => true,   // 调试模式
        'app_status'            => 'debug',// 调试模式状态
        'var_module'            => 'm',    // 模块变量名
        'var_controller'        => 'c',    // 控制器变量名
        'var_action'            => 'a',    // 操作变量名
        'var_pathinfo'          => 's',    // PATHINFO变量名 用于兼容模式
        'pathinfo_fetch'        => 'ORIG_PATH_INFO,REDIRECT_PATH_INFO,REDIRECT_URL',
        'pathinfo_depr'         => '/',    // pathinfo分隔符
        'require_module'        => true,   // 是否显示模块
        'default_module'        => 'index',  // 默认模块名
        'require_controller'    => true,   // 是否显示控制器
        'default_controller'    => 'index',    // 默认控制器名
        'default_action'        => 'index',    // 默认操作名
        'action_suffix'         => '', // 操作方法后缀
        'url_model'             => 1,  // URL模式
        'base_url'              => $_SERVER["SCRIPT_NAME"],    // 基础URL路径
        'url_html_suffix'       => '.html',
        'url_params_bind'       => false,  // url变量绑定
        'exception_tmpl'        => THINK_PATH.'Tpl/think_exception.tpl',// 异常页面的模板文件
        'error_tmpl'            => THINK_PATH.'Tpl/dispatch_jump.tpl', // 默认错误跳转对应的模板文件
        'success_tmpl'          => THINK_PATH.'Tpl/dispatch_jump.tpl', // 默认成功跳转对应的模板文件
        'default_ajax_return'   => 'JSON',  // 默认AJAX 数据返回格式,可选JSON XML ...
        'default_jsonp_handler' => 'jsonpReturn', // 默认JSONP格式返回的处理方法
        'var_jsonp_handler'     => 'callback',
        'template_engine'       =>  'think',

        /* 错误设置 */
        'error_message'     =>  '页面错误！请稍后再试～',//错误显示信息,非调试模式有效
        'error_page'        =>  '', // 错误定向页面
        'show_error_msg'    =>  false,    // 显示错误信息

        /* 数据库设置 */
        'database'    =>  [
            'type'              =>  'mysql',     // 数据库类型
            'dsn'               =>  '', // 
            'hostname'          =>  'localhost', // 服务器地址
            'database'          =>  '',          // 数据库名
            'username'          =>  'root',      // 用户名
            'password'          =>  '',          // 密码
            'hostport'          =>  '',        // 端口               
            'params'            =>  [], // 数据库连接参数        
            'charset'           =>  'utf8',      // 数据库编码默认采用utf8  
            'prefix'            =>  '',    // 数据库表前缀
            'debug'             =>  false, // 数据库调试模式
            'deploy'            =>  0, // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
            'rw_separate'       =>  false,       // 数据库读写是否分离 主从式有效
            'master_num'        =>  1, // 读写分离后 主服务器数量
            'slave_no'          =>  '', // 指定从服务器序号
        ],
    ],

    // 别名定义
    'alias'     =>  [
        'Think\Log'               => CORE_PATH . 'Log'.EXT,
        'Think\Log\Driver\File'   => CORE_PATH . 'Log/Driver/File'.EXT,
        'Think\Exception'         => CORE_PATH . 'Exception'.EXT,
        'Think\Model'             => CORE_PATH . 'Model'.EXT,
        'Think\Db'                => CORE_PATH . 'Db'.EXT,
        'Think\Template'          => CORE_PATH . 'Template'.EXT,
        'Think\Cache'             => CORE_PATH . 'Cache'.EXT,
        'Think\Cache\Driver\File' => CORE_PATH . 'Cache/Driver/File'.EXT,
        'Think\Storage'           => CORE_PATH . 'Storage'.EXT,
    ],

    'init'       =>  [],
];