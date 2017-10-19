<?php
/**
 * Created by PhpStorm.
 * User: Juvo
 * Date: 2017/10/19
 * Time: 20:09
 */

namespace app\admin\controller;


use data\model\baron\system\BaronUserModel;

class Element extends BaseController {
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

        return view($this->style . 'element/index');
    }

    /**
     * 产品类别
     */
    public function eleKind(){
        return view($this->style . 'element/eleKind');
    }
    /**
     * 添加产品
     */
    public function addEle(){

    }
}