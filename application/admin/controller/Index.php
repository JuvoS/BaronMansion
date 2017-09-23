<?php

namespace app\admin\controller;
use data\model\baron\system\BaronUserModel;

\think\Loader::addNamespace('data', 'data/');

class Index extends BaseController
{
    public function __construct()
    {
        parent::__construct();

    }

    public function index(){
        $userModel = new BaronUserModel();
        $userRes = $userModel->getAllData('','');
//        var_dump($userRes);
        $this->assign('userRes',$userRes[0]);
        return view($this->style . 'index/index');
    }
}