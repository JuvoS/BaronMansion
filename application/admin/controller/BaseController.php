<?php
namespace app\admin\controller;

use data\model\baron\system\BaronUserModel;
use think\Controller;
use think\Session;

\think\Loader::addNamespace('data', 'data/');

class BaseController extends Controller
{
    public $style;

    public function __construct()
    {
        parent::__construct();

        $this->init();

        $this->checkLoginStatus();
        $this->initUser();

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
//        Session::start();
        // 判断是否登陆
        if (Session::get('baronAdmin')) {
//        if (Session::get('baronAdmin')&& $_SESSION["baronAdmin"] != 0) {
//            echo "您已经成功登陆";
            $this->initUser();
        } else {
        // 验证失败，将 $_SESSION["admin"] 置为 false
            $_SESSION["admin"] = false;

//            die("Sorry,您无权访问");

        }
    }

    /**
     * 初始化操作者信息
     */
    public function initUser(){
        $userModel = new BaronUserModel();
        $userRes = $userModel->getAllData('','');
        $this->assign('userRes',$userRes[0]);
    }
    /**
     * 需要登陆
     */
    public function failPage($url=''){
        return view($this->style . 'Common/failPage');
    }
}