<?php
/**
 * Created by PhpStorm.
 * User: Juvo
 * Date: 2017/9/23
 * Time: 22:54
 */

namespace app\admin\controller;
use data\model\baron\system\BaronUserModel;
use data\service\baronUser;
use think\Controller;

\think\Loader::addNamespace('data', 'data/');

class Login extends Controller
{
    public $style;
    public function __construct()
    {
        parent::__construct();
        $this->style = 'admin/' . BARON_TEMPLATE . '/';
    }

    public function index(){
        if($_POST){
            $userName = isset($_POST['username'])?$_POST['username']:'';
            $psword = isset($_POST['psword'])?$_POST['psword']:'';

            $baronUserModel = new baronUser();
            $baronUserModel->login($userName,$psword);

            $baronUserModel = new baronUser();
            $loginStatus = $baronUserModel->login($userName,$psword);
            if($loginStatus){
                return array(
                    'flag'=>true,
                    'url'=>'index/index'
                );
            }
            return array(
                'flag'=>false,
                'url'=>$loginStatus
            );
        }
        return view($this->style . 'Login/index');
    }
}