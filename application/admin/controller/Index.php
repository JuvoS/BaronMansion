<?php

namespace app\admin\controller;
use data\model\baron\system\BaronUserModel;

\think\Loader::addNamespace('data', 'data/');

class Index extends BaseController
{
    public function __construct()
    {
        parent::__construct();

        $this->initIndex();
    }
    public function initIndex(){
        $userModel = new BaronUserModel();
        $userRes = $userModel->getAllData('','');
        $this->assign('userRes',$userRes[0]);
    }

    public function index(){

        return view($this->style . 'index/index');
    }
    /**
     * 查询
     */
    public function search(){
        return view($this->style . 'index/search/index');
    }
}