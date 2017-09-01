<?php
// +----------------------------------------------------------------------
// | ProjectName : domall
// +----------------------------------------------------------------------
// | Description :  登录类
// +----------------------------------------------------------------------
// | Copyright (c) 2015-2016 http://www.idowe.com All rights reserved.
// +----------------------------------------------------------------------
// | Authors : Johhny <chenjf@idowe.com>  Date : 2016-02-03
// +----------------------------------------------------------------------
namespace app\admin\controller;


class Login extends Base {

    /**
     * 构造函数
     * Login constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * 登录页面
     * @author Johhny <chenjf@idowe.com>
     */
    public function index(){
        return $this->display();

    }

    /**
     * 退出操作
     * @author Doogie <461960962@qq.com>
     */
    public function logout(){
        $this->systemSetKey(null);
        return $this->success('安全退出', url('Login/index'));
    }

}