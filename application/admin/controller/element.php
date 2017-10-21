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
        return view($this->style . 'Element/index');
    }

    /**
     * 产品类别
     */
    public function eleKind(){
        if($_POST){
            var_dump($_POST);
        }
        return view($this->style . 'Element/eleKind');
    }
    /**
     * 添加产品
     */
    public function addEle(){
        return view($this->style . 'Element/addEle');
    }
    /**
     * 添加产品
     */
    public function uploadEle(){
        return view($this->style . 'Element/uploadEle');
    }
    /**
     * 产品搜索
     */
    public function eleSearch(){
        return view($this->style . 'Element/eleSearch');
    }
}