<?php
namespace app\admin\controller;


use think\Controller;
use think\Session;

class BaseController extends Controller
{
    public $style;

    public function __construct()
    {
        parent::__construct();

        $this->init();

        $this->checkLoginStatus();

    }

    public function init(){
        $this->style = 'admin/' . BARON_TEMPLATE . '/';
    }
    public function checkUserSystem(){

    }
    /**
     * 检测是否登陆
     */
    public function checkLoginStatus(){
        // 防止全局变量造成安全隐患
        $admin = false;
        // 启动会话，这步必不可少
        Session::start();
        // 判断是否登陆
        if (isset($_SESSION["admin"]) && $_SESSION["admin"] === true) {
            echo "您已经成功登陆";
        } else {
        // 验证失败，将 $_SESSION["admin"] 置为 false
            $_SESSION["admin"] = false;
//            die("您无权访问");
            return redirect("Login/index");
        }
    }
}