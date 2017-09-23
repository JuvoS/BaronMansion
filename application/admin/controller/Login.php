<?php
/**
 * Created by PhpStorm.
 * User: Juvo
 * Date: 2017/9/23
 * Time: 22:54
 */

namespace app\admin\controller;
use data\model\baron\system\BaronUserModel;
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

            $baronModel = new BaronUserModel();
            if($baronModel->getInfo(array(
                'baron_user'=>$userName,
                'baron_pw'=>$psword
            ),'')){
                return array(
                    'flag'=>true,
                    'url'=>'index/index'
                );
            }
            return false;
        }
        return view($this->style . 'Login/index');
    }
}